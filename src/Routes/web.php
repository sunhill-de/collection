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
Route::get('/ajax/searchTags/{class?}', 'Sunhill\Collection\Controllers\AjaxController@searchTags');
Route::get('/ajax/searchObjects/{class}/{field}', 'Sunhill\Collection\Controllers\AjaxController@searchObjects');
Route::get('/ajax/searchArrayOfString/{class}/{field}', 'Sunhill\Collection\Controllers\AjaxController@getArrayOfStringSuggestion');