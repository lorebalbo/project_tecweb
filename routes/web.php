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

/* ADMIN */

/* Home Admin*/
//Route::get('/adminHome', 'HomeController@adminHome')->name('adminHome')->middleware('is_admin');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

/* Progetti */
Route::resource('admin/project', 'ProjectController')->except(['destroy'])->middleware('is_admin'); // Crea tutte le route per il CRUD di una risorsa
Route::get('/admin/project/{project}/delete', 'ProjectController@destroy')->middleware('is_admin');

/* Clienti */
Route::resource('admin/client', 'ClientController')->except(['destroy'])->middleware('is_admin');
Route::get('/admin/client/{client}/delete', 'ClientController@destroy')->middleware('is_admin');

/* Utenti */
Route::resource('admin/user', 'UserController')->except(['destroy'])->middleware('is_admin');
Route::get('/admin/user/{user}/delete', 'UserController@destroy')->middleware('is_admin');

/* Associazioni utente progetto */
Route::get('admin/user_project/{project}/index', 'UserProjectController@index')->name('userproject.index')->middleware('is_admin');
Route::get('admin/user_project/{project}/create', 'UserProjectController@create')->name('userproject.create')->middleware('is_admin');
Route::post('admin/user_project/store', 'UserProjectController@store')->name('userproject.store')->middleware('is_admin');
Route::get('admin/user_project/{project}/edit', 'UserProjectController@edit')->name('userproject.edit')->middleware('is_admin');
Route::get('admin/user_project/{user_project}/delete/{project}', 'UserProjectController@destroy')->name('userproject.destroy')->middleware('is_admin');

/* Report Admin */

/* 5) Visualizzare il totale delle ore spese per ogni progetto */
Route::get('admin/admin_report/project_hours', 'AdminReportController@project_hours')->name('admin_report.project_hours')->middleware('is_admin');
Route::post('admin/admin_report/search_project_hours', 'AdminReportController@search_project_hours')->name('admin_report.search_project_hours')->middleware('is_admin');

/* 6) Visualizzare il totale delle ore spese per ogni cliente  */ 
Route::get('admin/admin_report/client_hours', 'AdminReportController@client_hours')->name('admin_report.client_hours')->middleware('is_admin');
Route::post('admin/admin_report/search_client_hours', 'AdminReportController@search_client_hours')->name('admin_report.search_client_hours')->middleware('is_admin');




/* UTENTE SEMPLICE */

/* Home User */
Route::get('/home', 'HomeController@index')->name('home');

/* 3) Visualizzare il riepilogo delle ore spese su ogni progettp*/
Route::resource('report', 'ReportController')->except(['destroy'])->middleware('auth');
Route::get('/report/{report}/delete', 'ReportController@destroy')->middleware('auth');

/* 1) Diario mesile
 * 2)Inserimento/modifica/cancellazione scheda ore
 * 
 * Cerca attività tra due date
 */ 
Route::resource('work', 'WorkController')->except(['destroy'])->middleware('auth');
Route::get('/work/{work}/delete', 'WorkController@destroy')->middleware('auth');
Route::post('/work/search', 'WorkController@search')->name('work.search')->middleware('auth');











//Route::get('/home', 'ProjectController@index')->name('home');


/*
Route::resource('admin/user_project', 'UserProjectController')->except(['destroy'])->middleware('is_admin');
Route::get('/admin/user_project/{user_project}/delete', 'UserProjectController@destroy');*/

//Route::resource('admin/user_project', 'UserProjectController')->except(['destroy'])->middleware('is_admin');
//Route::get('/admin/user_project/{user_project}/delete', 'UserProjectController@destroy');;






