<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AreaInteresse;

class AreaInteresseController extends Controller {

    function index(Request $request) {
        if ($request->get("idAreaInteresse") == null) {
            $areaInteresse = new AreaInteresse();
        } else {
            $areaInteresse = AreaInteresse::Where('idAreaInteresse', $request->get("idAreaInteresse"))->first();
        }
        return view('areaInteresse.cadastro', array('areaInteresse' => $areaInteresse));
    }

    function listar() {
        return view('areaInteresse.lista', array('areaInteresse' => AreaInteresse::All()));
    }

    function salvar(Request $request) {
        $validatedData = $request->validate([
//            "nome" => "required|max:100",
        ]);
        if ($request->get('idAreaInteresse') == null) { 
            $areaInteresse = new AreaInteresse();
        } else {
            $areaInteresse = AreaInteresse::Where('idAreaInteresse', $request->get('idAreaInteresse'))->first();
        }

        $areaInteresse->nomeArea = $request->get('nome');
        $areaInteresse->save();
        return redirect()->action('AreaInteresseController@listar');
    }

    function excluir(Request $request) {
        if ($request->get('idAreaInteresse') != null) {
            $areaInteresse = AreaInteresse::Where('idAreaInteresse', $request->get('idAreaInteresse'))->first();
            $areaInteresse->delete();
            return redirect()->action('AreaInteresseController@listar');
        }
    }
}
