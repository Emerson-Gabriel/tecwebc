<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Formalizacao;
use App\AreaInteresse;
use App\TipoTrabalho;
use App\Professor;
use App\AlunoAreaInteresse;
use App\Aluno;
use App\Http\Controllers\FuncoesController;
use Carbon\Carbon;
use Storage;
use Illuminate\Http\UploadedFile;

class FormalizacaoController extends Controller {

    function index(Request $request) {
        if ($request->get("id") == null) {
            $formalizacao = new Formalizacao();
        } else {
            $formalizacao = Formalizacao::Where('idFormalizacao', $request->get("id"))->first();
        }
        return view('formalizacao.cadastro', array('formalizacao' => $formalizacao, 'aluno' => Aluno::All(), 'areaInteresse' => AreaInteresse::All(), 'tipoTrabalho' => TipoTrabalho::All(), 'professor' => Professor::All()));
    }

    function listar() {
        $formalizacao = DB::table('formalizacao')
                ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                ->join('professor', 'formalizacao.idProfessorOrientador', '=', 'professor.idProfessor')
                ->select('formalizacao.*', 'aluno.nome as nomeAluno', 'professor.nome as nomeProfessor')
                ->where('formalizacao.cancelada', '=', '0') //pegando somente formalizacoes ativas
                ->where('formalizacao.finalizado', '=', '0') //pegando somente os que ainda nao foram finalizados
                ->get();
        return view('formalizacao.lista', array('formalizacao' => $formalizacao));
    }

    function salvar(Request $request) {
        $validatedData = $request->validate([
//            "nome" => "required|max:100",
        ]);
        if ($request->get('idFormalizacao') == null) {
            $formalizacao = new Formalizacao();
        } else {
            $formalizacao = Formalizacao::Where('idFormalizacao', $request->get('idFormalizacao'))->first();
        }

        //verificação para ver se vai ser cancelada
        if ($request->get('cancelada')[0] == 1) {
            $formalizacao->cancelada = 1;
        }else{
            $formalizacao->cancelada = 0;
        }

        $formalizacao->ano = $request->get('ano');
        $formalizacao->titulo = $request->get('titulo');
        $formalizacao->idAluno = $request->get('aluno');
        $formalizacao->idAreaInteresse = $request->get('areaInteresse');
        $formalizacao->idTipo = $request->get('tipo');
        $formalizacao->idProfessorOrientador = $request->get('professorOrientador');
        $coorientadores = $request->get('professorCoorientador');

        //buscando o ultimo numero da formalizacao
        $sql = 'SELECT IFNULL(MAX(numero), 0) + 1 AS proximo_numero FROM `formalizacao` WHERE ano = ' . $request->get('ano');
        $numeroForm = DB::select($sql);
        
        $formalizacao->numero = $numeroForm[0]->proximo_numero;
        
        if (isset($coorientadores[0])) {
            $coorientador1 = $coorientadores[0];
        } else {
            $coorientador1 = null;
        }

        if (isset($coorientadores[1])) {
            $coorientador2 = $coorientadores[1];
        } else {
            $coorientador2 = null;
        }
        

        $formalizacao->idProfessorCoorientador1 = $coorientador1;
        $formalizacao->idProfessorCoorientador2 = $coorientador2;

        if ($request->hasFile('anexob')) {
            $name = uniqid(date('HisYmd'));
            // Recupera a extensão do arquivo
            $extension = $request->anexob->extension();
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
            // Faz o upload:
            $upload = $request->anexob->storeAs('anexob', $nameFile);
            if (!$upload)
                return redirect()
                                ->back()
                                ->with('error', 'Falha ao fazer upload')
                                ->withInput();

            $formalizacao->anexoB = $nameFile;
        } else {
            $formalizacao->anexoB = null;
        }
        
        $formalizacao->save();

        if ($request->get('enviarDoc')) { // se entrar aqui tem que enviar o email ja
            $return = FuncoesController::enviarEmail($request->get('aluno'), 1);
        }

        return redirect()->action('FormalizacaoController@listar');
    }

	function download(Request $request) { 
        return response()->download(storage_path("app/anexoB/" . $request->get("arquivo")));
    }
	
    function excluir(Request $request) {
        if ($request->get('idFormalizacao') != null) {
            $formalizacao = Formalizacao::Where('idFormalizacao', $request->get('idFormalizacao'))->first();
            $formalizacao->delete();
//             $sql = "delete from areainteresse where idAreaInteresse = ".$request->get('idAreaInteresse');
//            $deleted = DB::delete($sql);
            return redirect()->action('FormalizacaoController@listar');
        }
    }

    function enviarDoc(Request $request) {
        if ($request->get("id") != null) {
            $return = FuncoesController::enviarEmail($request->get("id"), 1); // primeiro parametro e o email do aluno, o segundo parametro e o tipo de email que e para enviar
            return redirect()->action('FormalizacaoController@listar');
        } else {
            return redirect()->action('FormalizacaoController@index');
        }
    }

    function listagemDocOk() {
        
    }
    
    function buscaProfessor(Request $request) {
        $areaInteresse = AlunoAreaInteresse::Where('idAluno', $request->get('idAluno'))->first();
        $areaInteresseCompleta = AreaInteresse::Where('idAreaInteresse', $areaInteresse->idAreaInteresse)->first();
        return $areaInteresseCompleta;
    }
    
    function listaCompleta(){
        $formalizacao = DB::table('formalizacao')
                ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                ->join('professor', 'formalizacao.idProfessorOrientador', '=', 'professor.idProfessor')
                ->select('formalizacao.*', 'aluno.nome as nomeAluno', 'professor.nome as nomeProfessor')
                ->get();
        return view('formalizacao.lista-completa', array('formalizacao' => $formalizacao));
    }
    
    public function geraPdf() {
        $info = DB::table('formalizacao')
                ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                ->join('professor', 'formalizacao.idProfessorOrientador', '=', 'professor.idProfessor')
                ->join('areainteresse', 'formalizacao.idAreaInteresse', '=', 'areainteresse.idAreaInteresse')
                ->select('formalizacao.*', 'aluno.nome as nomeAluno', 'professor.nome as nomeProfessor', 'aluno.*','professor.email as emailProfessor', 'aluno.telefone as telefoneAluno', 'professor.telefone as telefoneProfessor', 'professor.formacaoAcademica as formacaoAcademica', 'areainteresse.nomeArea as area')
                ->where('formalizacao.cancelada', '=', '0') //pegando somente formalizacoes ativas
                ->get();
        
        $caminho_arquivo = "uploads/Documentos/Formalizacao/anexoBteste.pdf";
        
        $dompdf= \PDF::loadView('arquivos.teste', compact('info', $info))
                        // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                        ->setPaper('a4', 'portrait');
//                        ->download('anexoB.pdf');
        file_put_contents($caminho_arquivo, $dompdf->output());
    }

}
