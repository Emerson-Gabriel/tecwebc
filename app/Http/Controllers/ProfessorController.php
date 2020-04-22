<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Professor;
use App\Disciplina;
use App\AreaInteresse;
use App\ProfessorAreaInteresse;

class ProfessorController extends Controller {

    function index(Request $request) {
        if ($request->get("idProfessor") == null) {
            $professor = new Professor();
        } else {
            $professor = Professor::Where('idProfessor', $request->get("idProfessor"))->first();
        }
        return view('professor.cadastro', array('professor' => $professor, 'areaInteresse' => AreaInteresse::All()));
    }

    function listar() {
//        $disciplina = DB::table('disciplina')
//            ->leftJoin('profDisc', 'disciplina.id', '=', 'profDisc.id_disc')
//            ->where('profDisc.id_prof', '=', $request->get("id"))
//            ->get();
        $professores = DB::table('professor')
                ->orderBy('nome', 'asc')
                ->get();
        return view('professor.lista', array('professor' => $professores));
    }

    function salvar(Request $request) {

        $validatedData = $request->validate([
            "nome" => "required|max:100",
            "telefone" => "required",
            "email" => "required",
            "formacaoAcademica" => "required",
            "areaInteresse" => "required",
        ]);



        if ($request->get('idProfessor') == null) { //novo
            $professor = new Professor();
        } else {//editar
            $professor = Professor::Where('idProfessor', $request->get('idProfessor'))->first();
        }
        
        date_default_timezone_set('America/Sao_Paulo');
        $professor->nome = $request->get('nome');
        $professor->telefone = $request->get('telefone');
        $professor->email = $request->get('email');
        $professor->formacaoAcademica = $request->get('formacaoAcademica');
        $professor->lattes = $request->get('lattes');
        
        $professor->save();
        
        //OBS.:antes de inserir na ProfessorAreaInteresse tenho que apagar o que ja esta la desse professor
        $areas = ProfessorAreaInteresse::Where('idProfessor', $professor->idProfessor);
        $areas->delete();
            
        $areas = $request->get('areaInteresse');
        for ($f =0; $f <= (count($areas)-1); $f++) {
            
            $area = $areas[$f];
            
            DB::table('professorareainteresse')->insert(
                    ['idAreaInteresse' => $area, 'idProfessor' => $professor->idProfessor]
            );
            
        }
                
        return redirect()->action('ProfessorController@listar');
    }

    function excluir(Request $request) {
        if ($request->get('idProfessor') != null) {
            $professor = Professor::Where('idProfessor', $request->get('idProfessor'))->first();
            $professor->delete();
            $areas = ProfessorAreaInteresse::Where('idProfessor', $request->get('idProfessor'));
            $areas->delete();
            return redirect()->action('ProfessorController@listar');
        }
    }

}
