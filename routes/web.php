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

Route::get('/', 'HomeController@welcome')->name('welcome');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/configuration/sep-types', 'Configuration\SepTypeController@index')->name('configuration.sep-type.index');
Route::get('/configuration/sep-types/create', 'Configuration\SepTypeController@create')->name('configuration.sep-type.create');
Route::post('/configuration/sep-types/create', 'Configuration\SepTypeController@store')->name('configuration.sep-type.save');
Route::get('/configuration/sep-types/edit/{id}', 'Configuration\SepTypeController@edit')->name('configuration.sep-type.edit');
Route::patch('/configuration/sep-types/update/{id}', 'Configuration\SepTypeController@update')->name('configuration.sep-type.update');
Route::delete('/configuration/sep-types/delete/{id}', 'Configuration\SepTypeController@destroy')->name('configuration.sep-type.destroy');

Route::get('/configuration/icons', 'Configuration\IconController@index')->name('configuration.icons.index');
Route::get('/configuration/icons/create', 'Configuration\IconController@create')->name('configuration.icons.create');
Route::post('/configuration/icons/create', 'Configuration\IconController@store')->name('configuration.icons.save');
Route::get('/configuration/icons/edit/{id}', 'Configuration\IconController@edit')->name('configuration.icons.edit');
Route::patch('/configuration/icons/update/{id}', 'Configuration\IconController@update')->name('configuration.icons.update');
Route::delete('/configuration/icons/delete/{id}', 'Configuration\IconController@destroy')->name('configuration.icons.destroy');

Route::get('/configuration/credentials', 'Configuration\CredentialController@index')->name('configuration.credentials.index');
Route::get('/configuration/pcn', 'Configuration\PcnController@index')->name('configuration.pcn.index');
Route::get('/configuration/pcn/create', 'Configuration\PcnController@create')->name('configuration.pcn.create');
Route::post('/configuration/pcn/create', 'Configuration\PcnController@store')->name('configuration.pcn.save');
Route::get('/configuration/pcn/edit/{id}', 'Configuration\PcnController@edit')->name('configuration.pcn.edit');
Route::patch('/configuration/pcn/update/{id}', 'Configuration\PcnController@update')->name('configuration.pcn.update');
Route::delete('/configuration/pcn/delete/{id}', 'Configuration\PcnController@destroy')->name('configuration.pcn.destroy');

Route::get('/kpics', 'KPIC\IndexController@index')->name('kpic.index');
Route::get('/kpics/create', 'KPIC\IndexController@create')->name('kpic.create');
Route::post('/kpics/create', 'KPIC\IndexController@store')->name('kpic.store');

Route::get('/lookup/create', 'Lookup\IndexController@create')->name('lookup.create');
Route::get('/lookup/show/{code}', 'Lookup\IndexController@show')->name('lookup.show');
Route::post('/lookup/create', 'Lookup\IndexController@search')->name('lookup.search');

Route::get('/dedup', 'Dedup\IndexController@index')->name('dedup.index');

Route::get('/mobility', 'Mobility\IndexController@index')->name('mobility.index');

Route::get('/list', 'AuditTrail\IndexController@index')->name('list.index');

Route::get('/seps', 'SepController@index')->name('seps.index');
Route::get('/seps/create', 'SepController@create')->name('seps.create');
Route::post('/seps/create', 'SepController@store')->name('seps.save');
Route::get('/seps/edit/{id}', 'SepController@edit')->name('seps.edit');
Route::patch('/seps/update/{id}', 'SepController@update')->name('seps.update');
Route::get('/seps/users/edit/{id}', 'SepController@editUsers')->name('seps.users.edit');
Route::patch('/seps/users/update/{id}', 'SepController@updateUsers')->name('seps.users.update');

Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::post('/users/create', 'UserController@store')->name('users.save');
