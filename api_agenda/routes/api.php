<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers\Api')->group(function(){

    Route::post('/contatos/adicionar', 'ContactController@create');

    Route::get('/contatos', 'ContactController@index' );

    Route::get('/contatos/{id}', 'ContactController@select' );

    Route::put('/contatos/{id}', 'ContactController@update');

    Route::delete('/contatos/{id}', 'ContactController@delete');

});
