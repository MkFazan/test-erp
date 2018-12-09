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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'ProjectController@index')->name('home');

    Route::resource('projects', 'ProjectController');
    Route::get('/export', 'ProjectController@export')->name('export.project');
    Route::get('/import', 'ProjectController@importForm')->name('import.project.form');
    Route::post('/import-file', 'ProjectController@import')->name('import.project.file');

});

