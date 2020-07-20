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
Route::get('/my-ads', 'SearchController@myAds')->name('my-ads');
Route::get('/search', 'SearchController@index')->name('search');


Route::prefix('categorias')->name('category.')->group(function(){
    Route::get('{slug}','CategoryController@show')->name('show');
    Route::get('', "CategoryController@index")->name('index');
});
Route::prefix('anuncios')->name('ads.')->group(function(){
    Route::get('/create', 'AdController@create')->name('create');
    Route::get('/{slug}/', 'AdController@show')->name('show');
    Route::post('', 'AdController@store')->name('store');

    Route::prefix('{ad}')->middleware('urlSignature')->group(function(){
        Route::put('/editar', 'AdController@editRequest')->name('editRequest');
        Route::get('/editar', 'AdController@edit')->name('edit');
        Route::delete('/borrar', 'AdController@destroyRequest')->name('destroyRequest');
        Route::match(['get', 'put'], '/update', 'AdController@update')->name('update');
        Route::match(['get', 'delete'], '/destroy', 'AdController@destroy')->name('destroy');
    });

});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', function(){
    dd( \App\Category::countErrors());
    //echo \App\Ad::find(1)->getURL('destroy');
})->name('test');
