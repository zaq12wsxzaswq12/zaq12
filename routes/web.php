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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/index', 'App\Http\Controllers\IndexController@index')->name('index');

Route::get('login/google', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle');
Route::get('login/google/callback', 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback');