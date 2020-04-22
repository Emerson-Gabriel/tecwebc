<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disciplina;
use App\Professor;

class DisciplinaController extends Controller
{
    function index(Request $request) {
        if ($request->get("id") == null) {
            $disciplina = new Disciplina();
        } else {
            $disciplina = Disciplina::Where('id', $request->get("id"))->first();
        }
        return view('disciplina.cadastro', array('disciplina' => $disciplina));
    }

    function listar() {
        return view('disciplina.lista', array('disciplina' => Disciplina::All()));
    }

    function salvar(Request $request) {
        $validatedData = $request->validate([
//            "nome" => "required|max:100",
        ]);
        if ($request->get('id') == null) { 
            $disciplina = new Disciplina();
        } else {
            $disciplina = Disciplina::Where('id', $request->get('id'))->first();
        }

        $disciplina->nome = $request->get('nome');
        $disciplina->save();
        return redirect()->action('DisciplinaController@listar');
    }

    function excluir(Request $request) {
        if ($request->get('id') != null) {
            $disciplina = Disciplina::Where('id', $request->get('id'))->first();
            $disciplina->delete();
            return redirect()->action('DisciplinaController@listar');
        }
    }
}
