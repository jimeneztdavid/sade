<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/cache', function () {
	Artisan::call('config:clear');
	Artisan::call('config:cache');
	Artisan::call('cache:clear');
	Artisan::call('migrate:fresh --seed');
	return 'cache is clear and migrations flushed';
});

Route::get('/link-storage', function() {
	Artisan::call('storage:link');
	return 'ok';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isadmin'] ], function() {
	Route::get('/', 'Admin\AdminViewsController@index');
	Route::get('/pnf', 'Admin\AdminViewsController@pnf')->name('pnf');
	Route::get('/lugares', 'Admin\AdminViewsController@lugares')->name('lugares');
	Route::get('/disciplinas', 'Admin\AdminViewsController@disciplinas')->name('disciplinas');
	Route::get('/categorias', 'Admin\AdminViewsController@categorias')->name('categorias');
	Route::get('/usuarios', 'Admin\AdminViewsController@usuarios')->name('usuarios');
	Route::get('/bitacora', 'Admin\AdminViewsController@bitacoras')->name('bitacoras');
	Route::get('/bitacora/{id}', 'Admin\AdminViewsController@bitacora')->name('bitacora');
	Route::get('/constancia-acreditacion', 'Admin\AdminViewsController@constanciaAcreditacion')->name('constancia.acreditacion');
	Route::get('/constancia-participacion', 'Admin\AdminViewsController@constanciaParticipacion')->name('constancia.participacion');
});

Route::group(['prefix' => 'profesor', 'middleware' => ['auth'] ], function() {
	Route::get('/', 'GeneralViewsController@index');
});

Route::middleware(['auth'])->group(function() {
	Route::get('/atletas', 'GeneralViewsController@atletas')->name('atletas');
	Route::get('/eventos', 'GeneralViewsController@eventos')->name('eventos');
	Route::get('/perfil', 'GeneralViewsController@perfil')->name('perfil');
	Route::post('/profile/update', 'ProfileController@updateProfileInfo');
});

Route::middleware(['auth', 'isadmin'])->group(function() {
	Route::resource('pnf', 'Admin\PnfController');
	Route::resource('disciplina', 'Admin\DisciplinaController');
	Route::resource('categoria', 'Admin\CategoriaController');
	Route::resource('usuario', 'Admin\UserController');
	Route::post('usuario-status', 'Admin\UserController@changeStatus');
	Route::resource('evento', 'EventoController');
	Route::resource('asistencia_evento', 'AtletasEventosController');
	Route::get('atletas/{id}', 'Admin\AtletaController@obtenerAtletasPorDisciplina');
	Route::get('atletas_no_registrados/evento/{id}', 'AtletasEventosController@atletasNoRegistradosEnEvento');
	Route::delete('excluir_atleta', 'AtletasEventosController@eliminar');
	Route::get('/agregar-atletas/{id_evento}', 'Admin\AdminViewsController@agregarAtletas')->name('agregar-atletas');
	Route::resource('bitacora', 'Admin\BitacoraController');
});

Route::resource('atleta', 'Admin\AtletaController');


// Route::get('/pdf/acreditacion', function() {
// 	$pdf = \PDF::loadView('pdf.acreditacion');
// 	return $pdf->stream('acreditacion.pdf');
// });

Route::get('/pdf/acreditacion/{id}', 'AcreditacionController');

Route::get('/participacion/evento/{evento_id}/atleta/{atleta_id}', 'PdfParticipacionController');

Route::get('/manual-usuario', function() {
	$file = public_path() . "/manual.pdf";

	$headers = array(
		'Content-Type: application/pdf',
	);

	return response()->download($file, 'manual-de-usuario.pdf', $headers);
});





Route::get('/logout', function() {
	Auth::logout();
	return redirect('/login');
});

