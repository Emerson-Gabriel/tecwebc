<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Local;

class LocalController extends Controller {

    function index(Request $request) {
        if ($request->get("idLocal") == null) {
            $local = new Local();
        } else {
            $local = Local::Where('idLocal', $request->get("idLocal"))->first();
        }
        return view('local.cadastro', array('local' => $local));
    }

    function listar() {
        $locais = DB::table('localprova')
                ->select('localprova.*')
                ->orderBy('descricao', 'asc')
                ->get();
         
        return view('local.lista', array('local' => $locais));
    }

    function salvar(Request $request) {
        $validatedData = $request->validate([
//            "nome" => "required|max:100",
        ]);
        if ($request->get('idLocal') == null) { 
            $local = new Local();
        } else {
            $local = Local::Where('idLocal', $request->get('idLocal'))->first();
        }

        $local->descricao = $request->get('descricao');
        $local->save();
        return redirect()->action('LocalController@listar');
    }

    function excluir(Request $request) {
        if ($request->get('idLocal') != null) {
            $local = Local::Where('idLocal', $request->get('idLocal'))->first();
            $local->delete();
            return redirect()->action('LocalController@listar');
        }
    }
}
