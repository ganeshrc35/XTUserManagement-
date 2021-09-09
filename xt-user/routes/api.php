<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    //Login API
    Route::post('/login', 'APIV1Controller@login');
});

Route::group(['middleware' => ['validate_bearer'],'prefix' => 'v1'], function () {
    Route::get('/getUser', 'APIV1Controller@getUser');
    Route::get('/logout','APIV1Controller@logout');
});
