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

use Illuminate\Support\Facades\Route;

Route::get('/task/{id?}', 'TaskController@index')->name('task');

Route::post('/task', 'TaskController@create')->name('task.create');

Route::put('/task/{id}', 'TaskController@update')->name('task.update');

Route::delete('/task/{id}', 'TaskController@delete')->name('task.delete');
