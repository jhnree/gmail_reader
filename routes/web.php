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

Route::get('/', 'IndexController@index');
Route::get('/login', 'IndexController@gmailLogin');
Route::get('/home', 'IndexController@home');
Route::get('/insert','DatabaseController@insertData');
Route::get('/paginate', 'DatabaseController@paginate');

Route::get('/sample', 'DatabaseController@testClass');

Route::get('/redirect', 'IndexController@redirect');
Route::get('/callback', 'IndexController@callback');


