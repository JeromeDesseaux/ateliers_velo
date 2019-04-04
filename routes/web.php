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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'WorkshopController@index')->name('workshop.index');
Route::get('/atelier/creer', 'WorkshopController@create')->name('workshop.create');
Route::get('/atelier/{slug}', 'WorkshopController@show')->name('workshop.details');
Route::post('/atelier/creer', 'WorkshopController@store')->name('workshop.store');
Route::get('/atelier/modifier/{slug}', 'WorkshopController@edit')->name('workshop.edit');
Route::put('/atelier/modifier/{slug}', 'WorkshopController@update')->name('workshop.update');
Route::delete('/atelier/supprimer/{slug}', 'WorkshopController@destroy')->name('workshop.destroy');

Route::get('/profil/{slug}', 'UserProfileController@show')->name('profile.show');

Route::post('/inscription/demande', 'InscriptionController@store')->name('inscription.store');