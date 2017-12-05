<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/response', function () {
    return view('/response');
});

Route::resource('admin/inicio','PrincipalController');
//Route::get('admin/categorias/{id}','PrincipalController@productos');

Route::get('admin/categoria/estado/{id}','CategoriaController@estado');
Route::resource('admin/categoria','CategoriaController');
Route::get('admin/producto/estado/{id}','ProductoController@estado');
Route::resource('admin/producto','ProductoController');
Route::get('admin/oferta/estado/{id}','OfertaController@estado');
Route::resource('admin/oferta','OfertaController');
Route::resource('admin/cliente','ClienteController');

Route::get('activacion/{code}','UserController@activate');
Route::post('complete/{id}','UserController@complete');


Route::auth();

Route::get('/Bienvenido', 'HomeController@index');
