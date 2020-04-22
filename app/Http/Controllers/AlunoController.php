<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aluno;
use App\AreaInteresse;
use App\Curso;
use App\AlunoAreaInteresse;

class AlunoController extends Controller {

    function index(Request $request) {
        if ($request->get("idAluno") == null) {
            $aluno = new Aluno();
        } else {
            $aluno = Aluno::Where('idAluno', $request->get("idAluno"))->first();
        }
        return view('aluno.cadastro', array('aluno' => $aluno, 'curso' => Curso::All(), 'areaInteresse' => AreaInteresse::All()));
    }

    function listar() {
        $aluno = DB::table('aluno')
                ->join('curso', 'aluno.idCurso', '=', 'curso.idCurso')
                ->select('aluno.*', 'curso.nome as nomeCurso')
                ->orderBy('nome', 'asc')
                ->get();
        
        return view('aluno.lista', array('aluno' => $aluno));
    }

    function salvar(Request $request) {
        $validatedData = $request->validate([
            "nome" => "required|max:100",
        ]);
        if ($request->get('idAluno') == null) { 
            $aluno = new Aluno();
        } else {
            $aluno = Aluno::Where('idAluno', $request->get('idAluno'))->first();
        }

        $aluno->nome = $request->get('nome');
        $aluno->sexo = $request->get('sexo');
        $aluno->email = $request->get('email');
        $aluno->matricula = $request->get('matricula');
        $aluno->telefone = $request->get('telefone');
        $aluno->rg = $request->get('rg');
        $aluno->cpf = $request->get('cpf');
        $aluno->orgaoExpeditor = $request->get('orgaoExpeditor');
        $aluno->idCurso = $request->get('curso');
        $aluno->save();
        // OBS.: Antes de inserir na alunoAreaInteresse tenho que apagar o que está lá primeiro
        $area = AlunoAreaInteresse::Where('idAluno', $aluno->idAluno);
        $area->delete();
        
        //agora faço o insert
        $alunoAreaInteresse= $request->get('areaInteresse');  //id area interesse, tenho que salvar na alunoareainteresse
        DB::table('alunoareainteresse')->insert(
                    ['idAluno' => $aluno->idAluno, 'idAreaInteresse' => $alunoAreaInteresse]
            );
        
        return redirect()->action('AlunoController@listar');
    }

    function excluir(Request $request) {
        if ($request->get('idAluno') != null) {
            $aluno = Aluno::Where('idAluno', $request->get('idAluno'))->first();
            $aluno->delete();
            $area = AlunoAreaInteresse::Where('idAluno', $request->get('idAluno'));
            $area->delete();
            return redirect()->action('AlunoController@listar');
        }
    }
}
