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
Route::get('/ajax/searchTags/{class?}/{field?}', 'Sunhill\Collection\Controllers\AjaxController@searchTags');
Route::get('/ajax/searchObjects/{class}/{field}', 'Sunhill\Collection\Controllers\AjaxController@searchObjects');
Route::get('/ajax/searchObject/{class}', 'Sunhill\Collection\Controllers\AjaxController@searchObject');
Route::get('/ajax/searchArrayOfString/{class}/{field}', 'Sunhill\Collection\Controllers\AjaxController@getArrayOfStringSuggestion');
Route::get('/ajax/searchClass/{class?}', 'Sunhill\Collection\Controllers\AjaxController@searchClass');
Route::get('/ajax/getClass/{class}', 'Sunhill\Collection\Controllers\AjaxController@getClass');
Route::get('/ajax/getAttributeType/{name}', 'Sunhill\Collection\Controllers\AjaxController@getAttributeType');
Route::get('/ajax/searchImportSeries', 'Sunhill\Collection\Controllers\AjaxController@searchImportSeries');
