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

Route::middleware('auth:api')->group(function () {
    Route::post('/kpics/generate', 'Api\IndexController@generate')->name('kpics.generate');
    Route::post('/kpics/lookup', 'Api\IndexController@lookup')->name('kpics.lookup');
    Route::get('/seps', 'Api\IndexController@seps')->name('seps.get');
    Route::get('/seps/types', 'Api\IndexController@sepsTypes')->name('seps.types');
});
