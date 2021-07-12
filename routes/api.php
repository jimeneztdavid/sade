<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('pnf', 'Admin\PnfController');
Route::resource('disciplina', 'Admin\DisciplinaController');
Route::resource('categoria', 'Admin\CategoriaController');
Route::resource('usuario', 'Admin\UserController');
Route::resource('atleta', 'Admin\AtletaController');
Route::resource('evento', 'EventoController');
Route::resource('asistencia_evento', 'AtletasEventosController');

Route::get('atletas/{id}', 'Admin\AtletaController@obtenerAtletasPorDisciplina');

Route::get('atletas_no_registrados/evento/{id}', 'AtletasEventosController@atletasNoRegistradosEnEvento');

Route::delete('excluir_atleta', 'AtletasEventosController@eliminar');

Route::post('/profile/update', 'ProfileController@updateProfileInfo');

Route::resource('bitacora', 'Admin\BitacoraController');

Route::post('usuario-status', 'Admin\UserController@changeStatus');