<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Curso;

class CursoController extends Controller {

    function index(Request $request) {
        if ($request->get("idCurso") == null) {
            $curso = new Curso();
        } else {
            $curso = Curso::Where('idCurso', $request->get("idCurso"))->first();
        }
        return view('curso.cadastro', array('curso' => $curso));
    }

    function listar() {
        return view('curso.lista', array('curso' => Curso::All()));
    }

    function salvar(Request $request) {
        $validatedData = $request->validate([
//            "nome" => "required|max:100",
        ]);
        if ($request->get('idCurso') == null) { 
            $curso = new Curso();
        } else {
            $curso = Curso::Where('idCurso', $request->get('idCurso'))->first();
        }

        $curso->nome = $request->get('nome');
        $curso->ppc = $request->get('ppc');
        $curso->resolucao = $request->get('resolucao');
        $curso->save();
        return redirect()->action('CursoController@listar');
    }

    function excluir(Request $request) {
        if ($request->get('idCurso') != null) {
            $curso = Curso::Where('idCurso', $request->get('idCurso'))->first();
            $curso->delete();
            return redirect()->action('CursoController@listar');
        }
    }
}
