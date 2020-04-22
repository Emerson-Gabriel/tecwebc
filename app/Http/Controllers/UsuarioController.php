<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsuarioController extends Controller
{
    
    function index(Request $request) {
        if ($request->get("id") == null) {
            $usuario = new User();
        } else {
            $usuario = User::Where('id', $request->get("id"))->first();
        }
        return view('usuario.cadastro', array('usuario' => $usuario));
    }
    
    function listar() {
        return view('usuario.lista', array('usuario' => User::All()));
    }
    
    function salvar(Request $request) {
        
        $validatedData = $request->validate([
            "nome" => "required|max:100",
            "email" => "email",
        ]);
        
        if ($request->get('id') == null) { //editar
            $usuario = new User();
        } else {
            $usuario = User::Where('id', $request->get('id'))->first();
        }
        
        $usuario->name = $request->get('nome');
        $usuario->email = $request->get('email');
        $usuario->password= Hash::make($request->get('password'));
        $usuario->save();
        return redirect()->action('UsuarioController@listar');
    }

    function excluir(Request $request) {
        if ($request->get('id') != null) {
            $usuario = User::Where('id', $request->get('id'))->first();
            $usuario->delete();
            return redirect()->action('UsuarioController@listar');
        }
    }
}
