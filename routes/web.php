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

/* Rutas Inicio*/
Route::get('/', function () { return view('login'); })->name('login');
Route::post('login','App\Http\Controllers\UsuariosController@login')->name('usuarios.procesar_login');
Route::get('inicio','App\Http\Controllers\UsuariosController@inicio')->name('usuarios.inicio');
Route::get('cerrar','App\Http\Controllers\UsuariosController@cerrar')->name('usuarios.cerrar');

/* Rutas usuarios */
Route::get('usuarios/listado','App\Http\Controllers\UsuariosController@index')->name('usuarios.index');
Route::get('usuarios/registro','App\Http\Controllers\UsuariosController@create')->name('usuarios.create');
Route::post('usuarios/registro-proceso','App\Http\Controllers\UsuariosController@store')->name('usuarios.store');
Route::get('usuarios/editar/{id?}','App\Http\Controllers\UsuariosController@edit')->name('usuarios.edit');
Route::post('usuarios/editar-proceso','App\Http\Controllers\UsuariosController@update')->name('usuarios.update');
Route::get('usuarios/eliminar/{id?}','App\Http\Controllers\UsuariosController@delete')->name('usuarios.delete');
Route::post('usuarios/eliminar-proceso','App\Http\Controllers\UsuariosController@delete_proceso')->name('usuarios.delete_proceso');

/* Rutas clientes */
Route::get('clientes','App\Http\Controllers\ClientesController@index')->name('clientes.index');
Route::get('clientes/registro','App\Http\Controllers\ClientesController@create')->name('clientes.create');
Route::post('clientes/registro-proceso','App\Http\Controllers\ClientesController@store')->name('clientes.store');
Route::get('clientes/editar/{id?}','App\Http\Controllers\ClientesController@edit')->name('clientes.edit');
Route::post('clientes/editar-proceso','App\Http\Controllers\ClientesController@update')->name('clientes.update');
Route::get('clientes/eliminar/{id?}','App\Http\Controllers\ClientesController@delete')->name('clientes.delete');
Route::post('clientes/eliminar-proceso','App\Http\Controllers\ClientesController@delete_proceso')->name('clientes.delete_proceso');




