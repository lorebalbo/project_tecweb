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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'ProjectController@index')->name('home');

Route::resource('project', 'ProjectController')->except(['destroy']); // Crea tutte le route per il CRUD di una risorsa
Route::get('/project/{project}/delete', 'ProjectController@destroy');

Route::resource('client', 'ClientController')->except(['destroy']);
Route::get('/client/{client}/delete', 'ClientController@destroy');
