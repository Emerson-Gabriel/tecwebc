<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cargo;

class CargoController extends Controller {

    function index(Request $request) {
        if ($request->get("idCargo") == null) {
            $cargo = new Cargo();
        } else {
            $cargo = Cargo::Where('idCargo', $request->get("idCargo"))->first();
        }
        return view('cargo.cadastro', array('cargo' => $cargo));
    }

    function listar() {
        return view('cargo.lista', array('cargo' => Cargo::All()));
    }

    function salvar(Request $request) {
        $validatedData = $request->validate([
//            "nome" => "required|max:100",
        ]);
        if ($request->get('idCargo') == null) { 
            $cargo = new Cargo();
        } else {
            $cargo = Cargo::Where('idCargo', $request->get('idCargo'))->first();
        }

        $cargo->nomeCargo = $request->get('nome');
        $cargo->save();
        return redirect()->action('CargoController@listar');
    }

    function excluir(Request $request) {
        if ($request->get('idCargo') != null) {
            $cargo = Cargo::Where('idCargo', $request->get('idCargo'))->first();
            $cargo->delete();
            return redirect()->action('CargoController@listar');
        }
    }
}
