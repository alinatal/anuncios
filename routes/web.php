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

Route::get('/', 'MainController@index')->name('main');
Route::get('/category/{slug}', 'CategoryController@index')->name('category');
Route::get('/ads/create', 'AdController@create')->name('ads.create');
Route::post('/ads', 'AdController@store')->name('ads.store');
Route::get('/my-ads', 'SearchController@myAds')->name('my-ads');

Route::get('/ads/{slug}', 'AdController@index')->name('ads.index');
Route::get('/search', 'SearchController@index')->name('search');
Route::get('/test', 'SearchController@test')->name('test');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
