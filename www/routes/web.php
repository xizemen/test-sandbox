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

Route::get('/', 'TaskController@index');

Route::get('/task', 'TaskController@index');

Route::get('/task/{id}', 'TaskController@get');

Route::post('/task', 'TaskController@create');

Route::put('/task/{id}', 'TaskController@update');

Route::delete('/task/{id}', 'TaskController@destroy');
