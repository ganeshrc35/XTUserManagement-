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

Route::get('/','UserController@showLogin')->name('showLogin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Auth'],function(){
    Route::get('/login','LoginController@index')->name('login');
    Route::post('/login','LoginController@authenticate')->name('authenticate');
});

Route::group(array('middleware' => ['auth','checkAdmin']), function () {
    Route::get('/dashboard','UserController@index')->name('getUsers');
    Route::get('/logout','UserController@logout')->name('logout');
    Route::get('/createUser','UserController@create')->name('create');
    Route::post('/createUser','UserController@store')->name('store');
    Route::get('/getUsers','UserController@get')->name('get');
    Route::get('/viewUser/{userId}','UserController@view')->name('view');
    Route::get('/edit/{userId}','UserController@edit')->name('edit');
    Route::post('/update/{userId}','UserController@update')->name('update');
    Route::get('/delete/{userId}','UserController@delete')->name('delete');
});

