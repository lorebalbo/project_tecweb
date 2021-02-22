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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

//Route::get('/home', 'ProjectController@index')->name('home');

Route::resource('admin/project', 'ProjectController')->except(['destroy'])->middleware('is_admin'); // Crea tutte le route per il CRUD di una risorsa
Route::get('/admin/project/{project}/delete', 'ProjectController@destroy');

Route::resource('admin/client', 'ClientController')->except(['destroy']);
Route::get('/admin/client/{client}/delete', 'ClientController@destroy');
