<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
Route::get('/getApi', function () {

   // $news=News::all();
  return  $news = DB::table('countries')
    ->join('sources', 'sources.source_country', '=', 'countries.country_code')
    ->join('news', 'news.source_id', '=', 'sources.id')
    ->select('news.*','country_name','source_name')
    ->orderBy('datetime', 'desc')
    ->get();
});
