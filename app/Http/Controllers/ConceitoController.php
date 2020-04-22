<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Conceito;

class ConceitoController extends Controller {

    function index(Request $request) {
        if ($request->get("idConceito") == null) {
            $conceito = new Conceito();
        } else {
            $conceito = Conceito::Where('idConceito', $request->get("idConceito"))->first();
        }
        return view('conceito.cadastro', array('conceito' => $conceito));
    }

    function listar() {
        return view('conceito.lista', array('conceito' => Conceito::All()));
    }

    function salvar(Request $request) {
        $validatedData = $request->validate([
//            "nome" => "required|max:100",
        ]);
        if ($request->get('idConceito') == null) { 
            $conceito = new Conceito();
        } else {
            $conceito = Conceito::Where('idConceito', $request->get('idConceito'))->first();
        }

        $conceito->min = $request->get('min');
        $conceito->max = $request->get('max');
        $conceito->save();
        return redirect()->action('ConceitoController@listar');
    }

    function excluir(Request $request) {
        if ($request->get('idConceito') != null) {
            $conceito = Conceito::Where('idConceito', $request->get('idConceito'))->first();
            $conceito->delete();
            return redirect()->action('ConceitoController@listar');
        }
    }
}
