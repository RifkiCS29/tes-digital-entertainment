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

Route::get('/calculator', 'CalculatorController@index')->name('calc');
Route::post('/calculate','CalculatorController@calculate')->name('calculate');

Route::get('/link', 'LinkController@index')->name('link');
Route::post('/shorten', 'LinkController@shorten')->name('shorten');
Route::get('/{code}', 'LinkController@directLink')->name('direct');

Route::get('/login-admin', function(){
    return view('auth.login');
});

Route::match(['get', 'post'],'/register', function () {
    return redirect('/login-admin');
})->name('register');

Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('videos', 'VideoController')->except(['show']);
});