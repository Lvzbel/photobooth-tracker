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
Route::get('/vehicles', 'VehicleController@index');
Route::get('/vehicles/create', 'VehicleController@create')->middleware('auth');
Route::get('/vehicles/date', 'VehicleController@date');
Route::get('/vehicles/search', 'VehicleController@search');
Route::get('/vehicles/today', 'VehicleController@today');
Route::get('/vehicles/{vehicle}', 'VehicleController@show');
Route::post('/vehicles', 'VehicleController@store');
Route::get('/vehicles/{vehicle}/edit', 'VehicleController@edit')->middleware('auth');
Route::patch('/vehicles/{vehicle}', 'VehicleController@update')->middleware('auth');
Route::delete('/vehicles/{vehicle}', 'VehicleController@destroy');
Route::get('/vehicles/disclosure/{vehicle}', 'VehicleController@disclosure')->name('disclosure');
Route::post('/vehicles/disclosure/submit', 'VehicleController@disclosures');

// Client Routes
Route::group(['middleware' => ['role:admin']], function() {
  Route::get('/clients', 'ClientController@index');
  Route::post('/clients', 'ClientController@store');
  Route::get('/clients/create', 'ClientController@create');
  Route::get('/clients/{client}/edit', 'ClientController@edit');
  Route::patch('/clients/{client}', 'ClientController@update');
  Route::delete('/clients/{client}', 'ClientController@destroy');
});
Route::get('/clients/all', 'ClientController@all');

// Admin Routes
Route::get('/admin', 'AdminController@index')->middleware(['role:admin|manager|photographer']);
Route::get('/admin/all', 'AdminController@all')->middleware(['role:admin|manager|photographer']);
// Admin API Calls
Route::post('/admin/grantrole', 'AdminController@grantrole');
Route::post('/admin/removerole', 'AdminController@removerole');