<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/viewuser', 'UserController@index');
Route::post('/updateuser', 'UserController@update');
Route::post('/insertuser', 'UserController@insert');
Route::delete('/deleteuser', 'UserController@delete');


Route::get('/viewsoal', 'SoalController@index');
Route::post('/updatesoal', 'SoalController@update');
Route::post('/insertsoal', 'SoalController@insert');
Route::delete('/deletesoal', 'SoalController@delete');
