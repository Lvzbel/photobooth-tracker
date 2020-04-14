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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

// Vehicle Routes
Route::get('/vehicles/create', 'VehicleController@create')->middleware('auth');
Route::get('/vehicles/date', 'VehicleController@date');
Route::get('/vehicles/{vehicle}', 'VehicleController@show');
Route::post('/vehicles', 'VehicleController@store');
Route::get('/vehicles/{vehicle}/edit', 'VehicleController@edit')->middleware('auth');
Route::patch('/vehicles/{vehicle}', 'VehicleController@update')->middleware('auth');
Route::delete('/vehicles/{vehicle}', 'VehicleController@destroy');

// Client Routes
Route::post('/clients', 'ClientController@store');
Route::get('/clients/create', 'ClientController@create');