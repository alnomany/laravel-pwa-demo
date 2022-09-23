<?php

use App\News;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\NewsController;



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


Route::get('/', 'NewsController@index')->name('index');

Route::get('/TestApi', 'NewsController@TestApi')->name('TestApi');



Route::get('/newsview/{id}', 'NewsController@view')->name('newsview');
Route::get('/search/all','NewsController@all')->name('search.all');

Route::get('/search','NewsController@getMoreTags')->name('search');



Route::get('keywords/search','NewsController@SearchKeywords')->name('SearchKeywords');




