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

Route::get('/signup', 'SignUpController@signup');
Route::post('/subscribe', 'SignUpController@subscribe');
Route::get('/compose', 'EmailController@compose');
Route::post('/send', 'EmailController@send');


Route::get('/subscribers', 'SignUpController@subscribers');
Route::get('/export', 'SignUpController@export');