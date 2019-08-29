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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')
                                           ->middleware('verified');

Route::resource('/tasks', 'TaskController');

Route::resource('/clients', 'ClientsController');

Route::resource('/notes', 'NotesController');

Route::resource('/jobs', 'JobsController');

Route::resource('/costs', 'CostsController');

Route::post('/percentage', 'WorkgroupController@percentage')->name('percentage');
Route::patch('/jobs/{id}/complete', 'Jobscontroller@complete')->name('jobs.complete');
Route::patch('/jobs/{id}/repair', 'WorkgroupController@repair')->name('jobs.repair');
