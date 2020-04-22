<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TipoTrabalho;

class TipoTrabalhoController extends Controller {

    function index(Request $request) {
        if ($request->get("idTipo") == null) {
            $tipoTrabalho = new TipoTrabalho();
        } else {
            $tipoTrabalho = TipoTrabalho::Where('idTipo', $request->get("idTipo"))->first();
        }
        return view('tipoTrabalho.cadastro', array('tipoTrabalho' => $tipoTrabalho));
    }

    function listar() {
        return view('tipoTrabalho.lista', array('tipoTrabalho' => TipoTrabalho::All()));
    }

    function salvar(Request $request) {
        $validatedData = $request->validate([
//            "nome" => "required|max:100",
        ]);
        if ($request->get('idTipo') == null) { 
            $tipoTrabalho = new TipoTrabalho();
        } else {
            $tipoTrabalho = TipoTrabalho::Where('idTipo', $request->get('idTipo'))->first();
        }

        $tipoTrabalho->nomeTipo = $request->get('nomeTipo');
        $tipoTrabalho->save();
        return redirect()->action('TipoTrabalhoController@listar');
    }

    function excluir(Request $request) {
        if ($request->get('idTipo') != null) {
            $tipoTrabalho = TipoTrabalho::Where('idTipo', $request->get('idTipo'))->first();
            $tipoTrabalho->delete();
            return redirect()->action('TipoTrabalhoController@listar');
        }
    }
}
