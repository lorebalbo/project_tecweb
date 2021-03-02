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

Route::resource('admin/client', 'ClientController')->except(['destroy'])->middleware('is_admin');
Route::get('/admin/client/{client}/delete', 'ClientController@destroy');

Route::resource('admin/user', 'UserController')->except(['destroy'])->middleware('is_admin');
Route::get('/admin/user/{user}/delete', 'UserController@destroy');
/*
Route::resource('admin/user_project', 'UserProjectController')->except(['destroy'])->middleware('is_admin');
Route::get('/admin/user_project/{user_project}/delete', 'UserProjectController@destroy');*/


Route::get('admin/user_project/{project}/index', 'UserProjectController@index')->name('userproject.index')->middleware('is_admin');
Route::get('admin/user_project/{project}/create', 'UserProjectController@create')->name('userproject.create')->middleware('is_admin');
Route::post('admin/user_project/store', 'UserProjectController@store')->name('userproject.store')->middleware('is_admin');
Route::get('admin/user_project/{project}/edit', 'UserProjectController@edit')->name('userproject.edit')->middleware('is_admin');

Route::get('admin/user_project/{user_project}/delete/{project}', 'UserProjectController@destroy')->name('userproject.destroy')->middleware('is_admin');


//Route::resource('admin/user_project', 'UserProjectController')->except(['destroy'])->middleware('is_admin');
//Route::get('/admin/user_project/{user_project}/delete', 'UserProjectController@destroy');;





//utente semplice

Route::resource('report', 'ReportController')->except(['destroy']);
Route::get('/report/{report}/delete', 'ReportController@destroy');

Route::resource('work', 'WorkController')->except(['destroy']);;
Route::get('/work/{work}/delete', 'WorkController@destroy');
Route::post('/work/search', 'WorkController@search')->name('work.search');





