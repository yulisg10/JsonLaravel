<?php

use Illuminate\Http\Request;

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

/*
Route::get('usuario', 'UsuarioController@index');
Route::get('usuario/{id}', 'UsuarioController@show');
Route::delete('usuario/{id}', 'UsuarioController@destroy');
Route::put('usuario/{id}', 'UsuarioController@store');
Route::post('usuario', 'UsuarioController@store');
*/


//***************************DIRECCIONA LA VISTA**********************************
Route::get('usuario/create', 'UsuarioController@create')->name('vista_registrar');

Route::get('usuario/show/{id}', 'UsuarioController@show')->name('vista_consultar');

Route::get('usuario/edit/{id}', 'UsuarioController@edit')->name('vista_editar');


//**********************************MÉTODO CRUD**********************************
Route::get('usuario', 'UsuarioController@index')->name('method_inicio');

Route::post('usuario', 'UsuarioController@store')->name('method_registrar');

Route::put('usuario/{id}', 'UsuarioController@update')->name('method_modificar_id');

Route::delete('usuario/{id}', 'UsuarioController@destroy')->name('method_eliminar_id');
