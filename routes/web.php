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

Auth::routes();

Route::get('/logout', function (){
    Auth::logout();
    return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');

// routes for social auth
Route::get('/login/{service}', 'Social\SocialAuth@redirectToProvider');
Route::get('/login/{service}/callback', 'Social\SocialAuth@handleProviderCallback');
