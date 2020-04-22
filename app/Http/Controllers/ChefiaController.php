<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Chefia;
use App\Professor;
use App\Cargo;

class ChefiaController extends Controller {

    function index(Request $request) {
        if ($request->get("idChefia") == null) {
            $chefia = new Chefia();
        } else {
            $chefia = Chefia::Where('idChefia', $request->get("idChefia"))->first();
        }
        return view('chefia.cadastro', array('chefia' => $chefia, 'cargo' => Cargo::All(), 'professor' => Professor::All()));
    }

    function listar() {
        $chefia = DB::table('chefia')
                ->join('cargo', 'chefia.idCargo', '=', 'cargo.idCargo')
                ->join('professor', 'chefia.idProfessor', '=', 'professor.idProfessor')
                ->select('chefia.*', 'cargo.nomeCargo', 'professor.nome as nomeProfessor')
                ->get();
        
        return view('chefia.lista', array('chefia' => $chefia));
    }

    function salvar(Request $request) {
        $validatedData = $request->validate([
//            "nome" => "required|max:100",
        ]);
        if ($request->get('idChefia') == null) { 
            $chefia = new Chefia();
        } else {
            $chefia = Chefia::Where('idChefia', $request->get('idChefia'))->first();
        }

        $chefia->portaria = $request->get('portaria');
        $chefia->dataInicio = $request->get('dataInicio');
        $chefia->dataFinal = $request->get('dataFinal');
        $chefia->idCargo = $request->get('cargo');
        $chefia->idProfessor = $request->get('professor');
        $chefia->save();
        return redirect()->action('ChefiaController@listar');
    }

    function excluir(Request $request) {
        if ($request->get('idChefia') != null) {
            $chefia = Chefia::Where('idChefia', $request->get('idChefia'))->first();
            $chefia->delete();
            return redirect()->action('ChefiaController@listar');
        }
    }
}
