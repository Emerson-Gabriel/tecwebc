<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Marcacao;
use App\Local;
use App\Formalizacao;
use App\MarcacaoProfessor;
use App\Professor;
use App\Http\Controllers\FuncoesController;
use Storage;
use Illuminate\Http\UploadedFile;
use App\Conceito;
use Carbon\Carbon;

class AtaViewModel {
    
    public $info = null;
    public $avaliadores = null;
    
    public function __construct($info, $avaliadores)
    {
        $this->info = $info;
        $this->avaliadores = $avaliadores;
    }
    
}

class MarcacaoController extends Controller {

    function index(Request $request) {
        if ($request->get("idMarcacao") == null) {
            $marcacao = new Marcacao();
            $sql = "SELECT CONCAT(a.titulo , ' - ' , b.nome, ' - ' ,c.nome) AS formalizacao,a.IdFormalizacao as idFormalizacao FROM formalizacao a INNER JOIN aluno b ON a.idAluno = b.idAluno INNER JOIN professor c ON a.idProfessorOrientador = c.idProfessor WHERE a.cancelada = 0 AND a.idFormalizacao NOT IN (SELECT idformalizacao from marcacao)";
        } else {// fazer consulta para levar tambem o nome do aluno e nome do professor
//        $results = DB::select('select * from users where id = :id', ['id' => 1]);
            $marcacao = Marcacao::Where('idMarcacao', $request->get("idMarcacao"))->first();
            $sql = "SELECT CONCAT(a.titulo , ' - ' , b.nome, ' - ' ,c.nome) AS formalizacao,a.IdFormalizacao as idFormalizacao FROM formalizacao a INNER JOIN aluno b ON a.idAluno = b.idAluno  INNER JOIN professor c ON a.idProfessorOrientador = c.idProfessor INNER JOIN marcacao d ON a.idFormalizacao = d.idFormalizacao WHERE d.idMarcacao = " . $request->get("idMarcacao");
        }
        $formalizacao = DB::select($sql);

        return view('marcacao.cadastro', array('marcacao' => $marcacao, 'local' => Local::All(), 'formalizacao' => $formalizacao, 'professor' => Professor::All()));
    }

    function listar() {
        $marcacao = DB::table('marcacao')
                ->join('formalizacao', 'marcacao.idFormalizacao', '=', 'formalizacao.idFormalizacao')
                ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                ->join('localprova', 'marcacao.idLocal', '=', 'localprova.idLocal')
                ->select('marcacao.*', 'aluno.nome as nomeAluno', 'localprova.descricao as descricao', 'formalizacao.titulo as tcc', 'aluno.nome as nomeAluno')
                ->where('marcacao.cancelada', '=', '0')
                ->where('formalizacao.finalizado', '=', '0') //pegando somente os que ainda nao foram finalizados
                ->get();
        return view('marcacao.lista', array('marcacao' => $marcacao));
    }

    function salvar(Request $request) {
        $validatedData = $request->validate([
//            "nome" => "required|max:100",
        ]);

        if ($request->get('idMarcacao') == null) {
            $marcacao = new Marcacao();
        } else {
            $marcacao = Marcacao::Where('idMarcacao', $request->get('idMarcacao'))->first();
        }

        //verificação para ver se vai ser cancelada
        if ($request->get('cancelada')[0] == 1) {
            $marcacao->cancelada = 1;
        } else {
            $marcacao->cancelada = 0;
        }

        $dataHora = $request->get('data') . " " . $request->get('hora');

        $marcacao->idFormalizacao = $request->get('formalizacao');
        $marcacao->idLocal = $request->get('local');
        $marcacao->dataHora = $dataHora;

        // anexo C
        if ($request->hasFile('anexoc')) {

            $name = uniqid(date('HisYmd'));
            // Recupera a extensão do arquivo
            $extension = $request->anexoc->extension();
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            // Faz o upload:
            $upload = $request->anexoc->storeAs('anexoc', $nameFile);
            if (!$upload)
                return redirect()
                                ->back()
                                ->with('error', 'Falha ao fazer upload')
                                ->withInput();

            $marcacao->anexoc = $nameFile;
        } else {
            $marcacao->anexoc = "";
        }

        // anexo G
        if ($request->hasFile('anexog')) {
            $name = uniqid(date('HisYmd'));
            // Recupera a extensão do arquivo
            $extension = $request->anexog->extension();
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            // Faz o upload:
            $upload = $request->anexog->storeAs('anexog', $nameFile);
            if (!$upload)
                return redirect()
                                ->back()
                                ->with('error', 'Falha ao fazer upload')
                                ->withInput();

            $marcacao->anexog = $nameFile;
        } else {
            $marcacao->anexog = "";
        }

        $marcacao->save();



        if ($request->get('idMarcacao') == null) {
            //verificando o id da marcacao recebida ou inserida
            $idMarcacao = $marcacao->idMarcacao;
            //inserir o orientador como diretor da banca {marcacaoprofessor}
            $formalizacao = DB::table('formalizacao')
                    ->join('professor', 'formalizacao.idProfessorOrientador', '=', 'professor.idProfessor')
//                ->select('professor.nome as nomeProfessor')
                    ->select('idProfessor')
                    ->where('idFormalizacao', '=', $request->get('formalizacao'))
                    ->get();

            $idProfessor = $formalizacao[0]->idProfessor;
            DB::table('marcacaoProfessor')->insert(
                    ['idProfessor' => $idProfessor, 'idMarcacao' => $idMarcacao, 'presidente' => 1]
            );

            //salvando avaliadores desta banca
            $avaliador = $request->get('avaliador');
            for ($f = 0; $f <= (count($avaliador) - 1); $f++) {
                $avaliadores = $avaliador[$f];
                DB::table('marcacaoProfessor')->insert(
                        ['idProfessor' => $avaliadores, 'idMarcacao' => $idMarcacao, 'presidente' => 0]
                );
            }
        }//e quando nao for nul?
        //
        //enviando documentação
        if ($request->get('enviarDoc')) { // se entrar aqui tem que enviar o email ja
            $return = FuncoesController::enviarEmail($request->get('formalizacao'), 2);
        }

        return redirect()->action('MarcacaoController@listar');
    }

	function downloadC(Request $request) { 
        return response()->download(storage_path("app/anexoC/" . $request->get("arquivo")));
    }
	
	function downloadG(Request $request) { 
        return response()->download(storage_path("app/anexoG/" . $request->get("arquivo")));
    }
	
    function excluir(Request $request) {
        if ($request->get('idMarcacao') != null) {
            $marcacao = Marcacao::Where('idMarcacao', $request->get('idMarcacao'))->first();
            $marcacao->delete();
            //excluir registro na MarcacaoProfessor
//            TESTARR
            $marcacaoProfessor = MarcacaoProfessor::Where('idMarcacao', $request->get('idMarcacao'));
            $marcacaoProfessor->delete();
            return redirect()->action('MarcacaoController@listar');
        }
    }

    function enviarDoc(Request $request) {
        if ($request->get("id") != null) {

            $formalizacao = DB::table('formalizacao')
                    ->join('marcacao', 'marcacao.idFormalizacao', '=', 'formalizacao.idFormalizacao')
                    ->where('marcacao.idMarcacao', '=', $request->get("id"))
                    ->get();
            $return = FuncoesController::enviarEmail($formalizacao[0]->idFormalizacao, 2); // primeiro parametro e o email do aluno, o segundo parametro e o tipo de email que e para enviar
            return redirect()->action('MarcacaoController@listar');
        } else {
            return redirect()->action('FormalizacaoController@index');
        }
    }

    function listaCompleta() {
        $marcacao = DB::table('marcacao')
                ->join('formalizacao', 'marcacao.idFormalizacao', '=', 'formalizacao.idFormalizacao')
                ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                ->join('localprova', 'marcacao.idLocal', '=', 'localprova.idLocal')
                ->select('marcacao.*', 'aluno.nome as nomeAluno', 'localprova.descricao as descricao', 'formalizacao.titulo as tcc', 'aluno.nome as nomeAluno')
                ->get();
        return view('marcacao.lista-completa', array('marcacao' => $marcacao));
    }

    public function geraPdf() {
//        $products = Product::all();
        return \PDF::loadView('certificado.certificado', compact('products'))
                        // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                        ->download('nome-arquivo-pdf-gerado.pdf');
    }

    public function geraAta(Request $request) {
        if ($request->get('idMarcacao') != null) {

            $info = DB::table('formalizacao')
                    ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                    ->join('marcacao', 'formalizacao.idFormalizacao', '=', 'marcacao.idFormalizacao')
                    ->join('professor', 'formalizacao.idProfessorOrientador', '=', 'professor.idProfessor')
                    ->join('areainteresse', 'formalizacao.idAreaInteresse', '=', 'areainteresse.idAreaInteresse')
                    ->join('curso', 'curso.idCurso', '=', 'aluno.idCurso')
                    ->select('marcacao.*', 'formalizacao.*', 'aluno.nome as nomeAluno', 'professor.nome as nomeProfessor', 'aluno.*', 'professor.email as emailProfessor', 'aluno.telefone as telefoneAluno', 'professor.telefone as telefoneProfessor', 'professor.formacaoAcademica as formacaoAcademica', 'areainteresse.nomeArea as area','curso.nome as nomeCurso','curso.ppc as ppcCurso')
                    ->where('marcacao.idMarcacao', '=', $request->get('idMarcacao'))
                    ->get();

            $avaliadores = DB::table('marcacaoProfessor')
                    ->join('professor', 'professor.idProfessor', '=', 'marcacaoProfessor.idProfessor')
                    ->select('professor.nome')
                    ->where('marcacaoProfessor.idMarcacao', '=', $info[0]->idMarcacao)
                    ->where('marcacaoProfessor.presidente', '=', 0)
                    ->get();
//                return view('arquivos.ata', array('info' => $info,'avaliadores' => $avaliadores));
            return \PDF::loadView('arquivos.ata', compact('info', 'avaliadores'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                            ->download($info[0]->nomeAluno.' - ATA da Defesa de TCC.pdf');
        }
    }
	
	function certificadoAvaliadores(Request $request) {
        if ($request->get('idMarcacao') != null) {

            $info = DB::table('formalizacao')
                    ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                    ->join('marcacao', 'formalizacao.idFormalizacao', '=', 'marcacao.idFormalizacao')
                    ->join('professor', 'formalizacao.idProfessorOrientador', '=', 'professor.idProfessor')
                    ->join('curso', 'curso.idCurso', '=', 'aluno.idCurso')
                    ->join('areainteresse', 'formalizacao.idAreaInteresse', '=', 'areainteresse.idAreaInteresse')
                    ->select('marcacao.*', 'formalizacao.*', 'aluno.nome as nomeAluno', 'professor.nome as nomeProfessor', 'aluno.*', 'professor.email as emailProfessor', 'aluno.telefone as telefoneAluno', 'professor.telefone as telefoneProfessor', 'professor.formacaoAcademica as formacaoAcademica', 'areainteresse.nomeArea as area')
                    ->where('marcacao.idMarcacao', '=', $request->get('idMarcacao'))
                    ->get();

            $avaliadores = DB::table('marcacaoProfessor')
                    ->join('professor', 'professor.idProfessor', '=', 'marcacaoProfessor.idProfessor')
                    ->select('professor.nome')
                    ->where('marcacaoProfessor.idMarcacao', '=', $info[0]->idMarcacao)
                    ->where('marcacaoProfessor.presidente', '=', 0)
                    ->get();

            $coordernadorADS = DB::table('chefia')
                    ->join('cargo', 'chefia.idCargo', '=', 'cargo.idCargo')
                    ->join('professor', 'chefia.idProfessor', '=', 'professor.idProfessor')
                    ->select('chefia.*', 'professor.nome as nomeCoordernadorADS')
                    ->where('cargo.idCargo', '=', 2) //passo o id do cargo que e coordenador do curso
                    ->get();

            $coordenadorEnsino = DB::table('chefia')
                    ->join('cargo', 'chefia.idCargo', '=', 'cargo.idCargo')
                    ->join('professor', 'chefia.idProfessor', '=', 'professor.idProfessor')
                    ->select('chefia.*', 'professor.nome as nomeCoordernadorEnsino')
                    ->where('cargo.idCargo', '=', 3) //passo o id do cargo que e coordenador do curso
                    ->get();

                //return view('arquivos.certificado-membro', array('info' => $info,'avaliadores' => $avaliadores,'coordernadorADS' => $coordernadorADS,'coordenadorEnsino' => $coordenadorEnsino));
            return \PDF::loadView('arquivos.certificado-membro', compact('info', 'avaliadores', 'coordernadorADS', 'coordenadorEnsino'))
                            ->setPaper('a4', 'landscape')
                            ->download($info[0]->nomeAluno.' - Certificado Membros da Banca.pdf');
        }
    }

    function certificadoOrientador(Request $request) {
        if ($request->get('idMarcacao') != null) {

            $info = DB::table('formalizacao')
                    ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                    ->join('marcacao', 'formalizacao.idFormalizacao', '=', 'marcacao.idFormalizacao')
                    ->join('professor', 'formalizacao.idProfessorOrientador', '=', 'professor.idProfessor')
                    ->join('areainteresse', 'formalizacao.idAreaInteresse', '=', 'areainteresse.idAreaInteresse')
                    ->join('curso', 'curso.idCurso', '=', 'aluno.idCurso')
                    ->select('marcacao.*', 'formalizacao.*', 'aluno.nome as nomeAluno', 'professor.nome as nomeProfessor', 'aluno.*', 'professor.email as emailProfessor', 'aluno.telefone as telefoneAluno', 'professor.telefone as telefoneProfessor', 'professor.formacaoAcademica as formacaoAcademica', 'areainteresse.nomeArea as area')
                    ->where('marcacao.idMarcacao', '=', $request->get('idMarcacao'))
                    ->get();

            $coordernadorADS = DB::table('chefia')
//                    ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                    ->join('cargo', 'chefia.idCargo', '=', 'cargo.idCargo')
                    ->join('professor', 'chefia.idProfessor', '=', 'professor.idProfessor')
                    ->select('chefia.*', 'professor.nome as nomeCoordernadorADS')
//                    ->where('chefia.idChefia', '=', 7) //id do coordenador
                    ->where('cargo.idCargo', '=', 2) //passo o id do cargo que e coordenador do curso
                    ->get();

            $coordenadorEnsino = DB::table('chefia')
//                    ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                    ->join('cargo', 'chefia.idCargo', '=', 'cargo.idCargo')
                    ->join('professor', 'chefia.idProfessor', '=', 'professor.idProfessor')
                    ->select('chefia.*', 'professor.nome as nomeCoordernadorEnsino')
//                    ->where('chefia.idChefia', '=', 7) //id do coordenador
                    ->where('cargo.idCargo', '=', 3) //passo o id do cargo que e coordenador do curso
                    ->get();

//            var_dump($coordernadorADS);
//                return view('arquivos.certificado-orientador', array('info' => $info,'coordernadorADS' => $coordernadorADS,'coordenadorEnsino' => $coordenadorEnsino));
            
            
            return \PDF::loadView('arquivos.certificado-orientador', compact('info', 'coordernadorADS', 'coordenadorEnsino'))
                            ->setPaper('a4', 'landscape')
                            ->download($info[0]->nomeAluno.' - Certificado Orientador do TCC.pdf');
        }
    }
    
    //http://localhost:8000/marcacao/geraatas?idMarcacao=54,53
    public function geraAtas(Request $request) {
        
        $dados = [];
        
        $contagem = 0;
        
        if ($request->get('idMarcacao') != null) {
            
            $ids = $request->get('idMarcacao');
            
            foreach (explode(",", $ids) as $id) {
                
                $contagem++;
                
                $info = DB::table('formalizacao')
                        ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                        ->join('marcacao', 'formalizacao.idFormalizacao', '=', 'marcacao.idFormalizacao')
                        ->join('professor', 'formalizacao.idProfessorOrientador', '=', 'professor.idProfessor')
                        ->join('areainteresse', 'formalizacao.idAreaInteresse', '=', 'areainteresse.idAreaInteresse')
                        ->join('curso', 'curso.idCurso', '=', 'aluno.idCurso')
                        ->select('marcacao.*', 'formalizacao.*', 'aluno.nome as nomeAluno', 'professor.nome as nomeProfessor', 'aluno.*', 'professor.email as emailProfessor', 'aluno.telefone as telefoneAluno', 'professor.telefone as telefoneProfessor', 'professor.formacaoAcademica as formacaoAcademica', 'areainteresse.nomeArea as area','curso.nome as nomeCurso','curso.ppc as ppcCurso')
                        ->where('marcacao.idMarcacao', '=', $id)
                        ->get();

                $avaliadores = DB::table('marcacaoProfessor')
                        ->join('professor', 'professor.idProfessor', '=', 'marcacaoProfessor.idProfessor')
                        ->select('professor.nome')
                        ->where('marcacaoProfessor.idMarcacao', '=', $info[0]->idMarcacao)
                        ->where('marcacaoProfessor.presidente', '=', 0)
                        ->get();

                $vm = new AtaViewModel($info, $avaliadores);
    //                return view('arquivos.atas', array('info' => $info,'avaliadores' => $avaliadores));

                $dados[] = $vm;
                
            }
            
        }
        
        if ($contagem == 1) {
            $nome_ata = $info[0]->nomeAluno.' - ATA da Defesa de TCC.pdf';
        } else {
            $nome_ata = 'ATAS da Defesa de TCC.pdf';
        }
        
        return \PDF::loadView('arquivos.atas', compact('dados'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                            ->download($nome_ata);
    }

}
