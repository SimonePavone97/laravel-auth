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

//Route::get('/', function () {
//    return view('guest.home');
//});

Auth::routes();

Route::middleware('auth')
->prefix('admin') //evito di scrivere il prefisso manualmente
->name('admin.') //tutte le rotte inizieranno con admin
->namespace('Admin') //gestisce il path del controller
->group(function(){
    Route::get('/', 'HomeController@index')->name('home ');
    Route::resource('posts', 'PostController');
});

Route::get('{any?}', function(){
    return view('guest.home');
})->where("any", ".*");
