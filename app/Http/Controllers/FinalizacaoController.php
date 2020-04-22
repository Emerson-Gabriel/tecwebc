<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Finalizacao;
use App\Marcacao;
use App\Formalizacao;
use App\Conceito;
use Carbon\Carbon;
use Storage;
use Illuminate\Http\UploadedFile;

class FinalizacaoController extends Controller {

    function index(Request $request) {
        if ($request->get("id") == null) {
            $finalizacao = new Finalizacao();
            $sql = "SELECT CONCAT(a.titulo , ' - ' , b.nome, ' - ' ,c.nome) AS formalizacao,d.idMarcacao as idMarcacao,d.dataHora FROM formalizacao a INNER JOIN aluno b ON a.idAluno = b.idAluno  INNER JOIN professor c ON a.idProfessorOrientador = c.idProfessor inner join marcacao d ON d.idFormalizacao = a.idFormalizacao WHERE a.finalizado = 0";
        } else {
            $finalizacao = Finalizacao::Where('id', $request->get("id"))->first();
            $sql = "SELECT CONCAT(a.titulo , ' - ' , b.nome, ' - ' ,c.nome) AS formalizacao,a.IdFormalizacao as idFormalizacao,d.dataHora FROM formalizacao a INNER JOIN aluno b ON a.idAluno = b.idAluno  INNER JOIN professor c ON a.idProfessorOrientador = c.idProfessor INNER JOIN marcacao d ON a.idFormalizacao = d.idFormalizacao WHERE d.idMarcacao = " . $request->get("idMarcacao");
        }

        $formalizacao = DB::select($sql);
//        var_dump($formalizacao);
        return view('finalizacao.cadastro', array('finalizacao' => $finalizacao, 'marcacao' => Marcacao::All(), 'formalizacao' => $formalizacao, 'conceito' => Conceito::All()));
    }

    function listar() {
        return view('finalizacao.lista', array('finalizacao' => Finalizacao::All()));
    }

    function salvar(Request $request) {

        $validatedData = $request->validate([
//            "nome" => "required|max:100",
        ]);

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        //tirou editar porque finalizacao nao edita
        $finalizacao = new Finalizacao();

        $finalizacao->idMarcacao = $request->get('idMarcacao');
        $finalizacao->nota = $request->get('nota');
        //buscando o conceito da finalizacao
        $sql = "SELECT conceito.idConceito FROM conceito WHERE ".$request->get('nota')." >= min AND ". $request->get('nota') . " <= max ";

//        echo $sql;
        $conceito = DB::select($sql);
//        var_dump($conceito);
        $finalizacao->finalizado = 1;
        $finalizacao->tituloFinal = $request->get('tituloFinal');
        $finalizacao->dataFinalizacao = date("Y/m/d");
        $finalizacao->idConceito = $conceito[0]->idConceito;
        //finalizando na marcacao
        Marcacao::where('idMarcacao', $request->get('idMarcacao'))
                ->update(['finalizado' => 1]);

        //buscando id da formalizacao na tabela de marcacao
        $sql = 'SELECT idFormalizacao FROM marcacao where idMarcacao = ' . $request->get('idMarcacao');
        $marcacao = DB::select($sql);
        $idFormalizacao = $marcacao[0]->idFormalizacao;

        //finalizando a marcacao
        Formalizacao::where('idFormalizacao', $idFormalizacao)
                ->update(['finalizado' => 1]);

        // anexo I
        if ($request->hasFile('anexoi')) {

            $name = uniqid(date('HisYmd'));
            // Recupera a extensão do arquivo
            $extension = $request->anexoi->extension();
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            // Faz o upload:
            $upload = $request->anexoi->storeAs('anexoi', $nameFile);
            if (!$upload)
                return redirect()
                                ->back()
                                ->with('error', 'Falha ao fazer upload')
                                ->withInput();

            $finalizacao->anexoi = $nameFile;
        } else {
            $finalizacao->anexoi = "";
        }

        $finalizacao->save();
        return redirect()->action('FinalizacaoController@listar');
    }

    function excluir(Request $request) {
        if ($request->get('idMarcacao') != null) {
            echo $request->get('idMarcacao');
            $finalizacao = Finalizacao::Where('idMarcacao', $request->get('idMarcacao'))->first();
            $finalizacao->delete();
            return redirect()->action('FinalizacaoController@listar');
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
                    ->where('cargo.idCargo', '=', 3) //passo o id do cargo que e coordenador do curso
                    ->get();

            $coordenadorEnsino = DB::table('chefia')
                    ->join('cargo', 'chefia.idCargo', '=', 'cargo.idCargo')
                    ->join('professor', 'chefia.idProfessor', '=', 'professor.idProfessor')
                    ->select('chefia.*', 'professor.nome as nomeCoordernadorEnsino')
                    ->where('cargo.idCargo', '=', 4) //passo o id do cargo que e coordenador do curso
                    ->get();

//                return view('arquivos.certificado-membro', array('info' => $info,'avaliadores' => $avaliadores,'coordernadorADS' => $coordernadorADS,'coordenadorEnsino' => $coordenadorEnsino));
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
                    ->where('cargo.idCargo', '=', 3) //passo o id do cargo que e coordenador do curso
                    ->get();

            $coordenadorEnsino = DB::table('chefia')
//                    ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                    ->join('cargo', 'chefia.idCargo', '=', 'cargo.idCargo')
                    ->join('professor', 'chefia.idProfessor', '=', 'professor.idProfessor')
                    ->select('chefia.*', 'professor.nome as nomeCoordernadorEnsino')
//                    ->where('chefia.idChefia', '=', 7) //id do coordenador
                    ->where('cargo.idCargo', '=', 4) //passo o id do cargo que e coordenador do curso
                    ->get();

//            var_dump($coordernadorADS);
//                return view('arquivos.certificado-orientador', array('info' => $info,'coordernadorADS' => $coordernadorADS,'coordenadorEnsino' => $coordenadorEnsino));

            return \PDF::loadView('arquivos.certificado-orientador', compact('info', 'coordernadorADS', 'coordenadorEnsino'))
                            ->setPaper('a4', 'landscape')
                            ->download($info[0]->nomeAluno.' - Certificado Orientador do TCC.pdf');
        }
    }

    function ataCRCA(Request $request) {
        if ($request->get('idMarcacao') != null) {

            $info = DB::table('formalizacao')
                    ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                    ->join('marcacao', 'formalizacao.idFormalizacao', '=', 'marcacao.idFormalizacao')
                    ->join('professor', 'formalizacao.idProfessorOrientador', '=', 'professor.idProfessor')
                    ->join('areainteresse', 'formalizacao.idAreaInteresse', '=', 'areainteresse.idAreaInteresse')
                    ->join('curso', 'curso.idCurso', '=', 'aluno.idCurso')
                    ->join('tipotrabalho', 'formalizacao.idTipo', '=', 'formalizacao.idTipo')
                    ->join('finalizacao', 'finalizacao.idMarcacao', '=', 'marcacao.idMarcacao')
                    ->join('conceito', 'conceito.idConceito', '=', 'finalizacao.idConceito')
                    ->select('aluno.sexo','tipotrabalho.nomeTipo as nomeTipo','conceito.conceito as conceito','finalizacao.*','finalizacao.nota','marcacao.*', 'formalizacao.*', 'aluno.nome as nomeAluno', 'professor.nome as nomeProfessor', 'aluno.*', 'professor.email as emailProfessor', 'aluno.telefone as telefoneAluno', 'professor.telefone as telefoneProfessor', 'professor.formacaoAcademica as formacaoAcademica', 'areainteresse.nomeArea as area','curso.nome as nomeCurso')
                    ->where('marcacao.idMarcacao', '=', $request->get('idMarcacao'))
                    ->get();
            
            $coordenadorTCC = DB::table('chefia')
                    ->join('cargo', 'chefia.idCargo', '=', 'cargo.idCargo')
                    ->join('professor', 'chefia.idProfessor', '=', 'professor.idProfessor')
                    ->select('chefia.*', 'professor.nome as nomeCoordernadorTCC','chefia.portaria')
                    ->where('cargo.idCargo', '=', 1) //passo o id do cargo que e coordenador de TCC
                    ->get();

//            echo '<pre>';
//            var_dump($info);
//            echo '</pre>';
//            return view('arquivos.declaracao', array('info' => $info,'coordenadorTCC' => $coordenadorTCC));


            return \PDF::loadView('arquivos.declaracao', compact('info','coordenadorTCC'))
//             ->setPaper('a4', 'landscape')
                            ->download($info[0]->nomeAluno.' - ATA CRCA.pdf');
        }
    }

}
