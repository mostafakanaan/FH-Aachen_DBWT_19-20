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

//Get Routes
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/produkte/{limit}/{avail}/{vegan}', 'ProdukteController@index')->name('produkte');
Route::get('/details/{id}', 'DetailsController@index')->name('detail'); //FIXME: add GET parameter for Mahlzeit..

//Post Routes
Route::post('/login/{id}', 'DetailsController@auth')->name('login');
