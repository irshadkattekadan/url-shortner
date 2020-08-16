<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', ['as'=> '/', 'uses' => 'Auth\LoginController@showLoginForm']);

Auth::routes();
Route::get('u/{code}', ['as' => 'shorten-url', 'uses' => 'UrlController@getShortenUrl']);
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::group(['prefix' => 'url', 'as' => 'url.'], function () {

        Route::get('urls', 'UrlController@index')->name('index');
        Route::post('urls', 'UrlController@store')->name('create');

    });

});
