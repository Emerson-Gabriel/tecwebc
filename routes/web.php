<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('layouts.master');});
Route::get('/index', 'HomeController@index')->name('home');


/*-----------------------------------*\
    $ROTAS ALUNO
\*-----------------------------------*/

Route::get('/aluno/listar','AlunoController@listar');
Route::post('/aluno/salvar','AlunoController@salvar');
Route::get('aluno/excluir','AlunoController@excluir');
Route::get('aluno','AlunoController@index');


/*-----------------------------------*\
    $ROTAS ÁREAS DE INTERESSE
\*-----------------------------------*/

Route::get('/area-de-interesse/listar','AreaInteresseController@listar');
Route::post('/area-de-interesse/salvar','AreaInteresseController@salvar');
Route::get('area-de-interesse/excluir','AreaInteresseController@excluir');
Route::get('area-de-interesse','AreaInteresseController@index');


/*-----------------------------------*\
    $ROTAS CARGO
\*-----------------------------------*/

Route::get('/cargo/listar','CargoController@listar');
Route::post('/cargo/salvar','CargoController@salvar');
Route::get('cargo/excluir','CargoController@excluir');
Route::get('cargo','CargoController@index');


/*-----------------------------------*\
    $ROTAS CHEFIA
\*-----------------------------------*/

Route::get('/chefia/listar','ChefiaController@listar');
Route::post('/chefia/salvar','ChefiaController@salvar');
Route::get('chefia/excluir','ChefiaController@excluir');
Route::get('chefia','ChefiaController@index');


/*-----------------------------------*\
    $ROTAS CONCEITO
\*-----------------------------------*/

Route::get('/conceito/listar','ConceitoController@listar');
Route::post('/conceito/salvar','ConceitoController@salvar');
Route::get('conceito/excluir','ConceitoController@excluir');
Route::get('conceito','ConceitoController@index');


/*-----------------------------------*\
    $ROTAS CURSO
\*-----------------------------------*/

Route::get('/curso/listar','CursoController@listar');
Route::post('/curso/salvar','CursoController@salvar');
Route::get('curso/excluir','CursoController@excluir');
Route::get('curso','CursoController@index');


/*-----------------------------------*\
    $ROTAS LOCAL
\*-----------------------------------*/

Route::get('/local/listar','LocalController@listar');
Route::post('/local/salvar','LocalController@salvar');
Route::get('local/excluir','LocalController@excluir');
Route::get('local','LocalController@index');


/*-----------------------------------*\
    $ROTAS PROFESSOR
\*-----------------------------------*/

Route::get('/professor/listar','ProfessorController@listar');
Route::post('/professor/salvar','ProfessorController@salvar');
Route::get('professor/excluir','ProfessorController@excluir');
Route::get('professor','ProfessorController@index');



/*-----------------------------------*\
    $ROTAS TIPO DE TRABALHO
\*-----------------------------------*/

Route::get('/tipo-de-trabalho/listar','TipoTrabalhoController@listar');
Route::post('/tipo-de-trabalho/salvar','TipoTrabalhoController@salvar');
Route::get('tipo-de-trabalho/excluir','TipoTrabalhoController@excluir');
Route::get('tipo-de-trabalho','TipoTrabalhoController@index');

/*-----------------------------------*\
    $ROTAS FORMALIZAÇÃO
\*-----------------------------------*/

Route::get('/formalizacao/professor','FormalizacaoController@buscaProfessor');
Route::get('/formalizacao/listar','FormalizacaoController@listar');
Route::post('/formalizacao/salvar','FormalizacaoController@salvar');
Route::get('formalizacao/excluir','FormalizacaoController@excluir');
Route::get('formalizacao/enviardoc','FormalizacaoController@enviarDoc');
Route::get('formalizacao/download','FormalizacaoController@download');
Route::get('formalizacao','FormalizacaoController@index');
Route::get('/formalizacao/lista-completa','FormalizacaoController@listaCompleta');
//arquivo
Route::get('formalizacao/gerapdf','FormalizacaoController@geraPdf');

/*-----------------------------------*\
    $ROTAS MARCAÇÃO
\*-----------------------------------*/

Route::get('/marcacao/lista-completa','MarcacaoController@listaCompleta');
Route::get('/marcacao/listar','MarcacaoController@listar');
Route::post('/marcacao/salvar','MarcacaoController@salvar');
Route::get('marcacao/excluir','MarcacaoController@excluir');
Route::get('marcacao','MarcacaoController@index');
Route::get('marcacao/enviardoc','MarcacaoController@enviarDoc');
//teste
Route::get('marcacao/gerapdf','MarcacaoController@geraPdf');
Route::get('marcacao/geraata','MarcacaoController@geraAta');
Route::get('marcacao/downloadC','MarcacaoController@downloadC');
Route::get('marcacao/downloadG','MarcacaoController@downloadG');
Route::get('marcacao/certificadoOrientador','MarcacaoController@certificadoOrientador');
Route::get('marcacao/certificadoAvaliadores','MarcacaoController@certificadoAvaliadores');

/*-----------------------------------*\
    $ROTAS FINALIZACAO
\*-----------------------------------*/

Route::get('/finalizacao/lista-completa','FinalizacaoController@listaCompleta');
Route::get('/finalizacao/listar','FinalizacaoController@listar');
Route::post('/finalizacao/salvar','FinalizacaoController@salvar');
Route::get('finalizacao/excluir','FinalizacaoController@excluir');
Route::get('finalizacao','FinalizacaoController@index');
//certificados
Route::get('finalizacao/certificadoOrientador','FinalizacaoController@certificadoOrientador');
Route::get('finalizacao/certificadoAvaliadores','FinalizacaoController@certificadoAvaliadores');
Route::get('finalizacao/ataCRCA','FinalizacaoController@ataCRCA');
/*-----------------------------------*\
    $ROTAS Usuario
\*-----------------------------------*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
