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
Route::get('/mantenimiento', function (){
    if(app()->isDownForMaintenance()) return view('frontend.maintenance');
    else return redirect()->route('main');
})->name('maintenance');
Route::get('/mis-anuncios', 'SearchController@myAds')->name('my-ads');
Route::get('/mis-favoritos', 'FavController@index')->name('fav.index');
Route::get('/mis-favoritos/{ad}', 'FavController@store')->name('fav.store');
Route::delete('/mis-favoritos/{ad}', 'FavController@destroy')->name('fav.destroy');
Route::get('/buscar', 'SearchController@index')->name('search');
Route::post('/denuncia/{ad:slug}', 'ReportController@report')->name('report');


Route::prefix('categorias')->name('category.')->group(function(){
    Route::get('{category:slug}','CategoryController@show')->name('show');
    Route::get('/', "CategoryController@index")->name('index');
});
Route::prefix('anuncios')->name('ads.')->middleware('optimizeImages')->group(function(){
    Route::get('crear/{category:slug}', 'AdController@create')->name('createe');
    Route::get('crear/', 'AdController@create')->name('create');
    Route::post('', 'AdController@store')->name('store');

    Route::prefix('{ad:slug}')->group(function(){

        Route::get('', 'AdController@show')->name('show');

        Route::middleware('urlSignature')->group(function(){
            Route::get('renovar', 'AdController@renovate')->name('renovate');
            Route::put('editar', 'AdController@editRequest')->name('editRequest');
            Route::get('editar', 'AdController@edit')->name('edit');
            Route::delete('borrar', 'AdController@destroyRequest')->name('destroyRequest');
            Route::match(['get', 'put'], 'update', 'AdController@update')->name('update');
            Route::match(['get', 'delete'], 'destroy', 'AdController@destroy')->name('destroy');
        });
    });

});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('admin')->middleware('checkAdmin')->prefix('admin')->name('admin.')->group(function(){

    Route::prefix('settings')->name('settings.')->group(function(){
        Route::get('', 'SettingsController@edit')->name('edit');
        Route::put('', 'SettingsController@update')->name('update');
    });

    Route::prefix('page')->name('pages.')->group(function(){
        Route::get('', 'PagesController@index')->name('index');
        Route::get('create', 'PagesController@create')->name('create');
        Route::post('', 'PagesController@store')->name('store');
        Route::get('{page:slug}/edit', 'PagesController@edit')->name('edit');
        Route::put('{page:slug}', 'PagesController@update')->name('update');
        Route::delete('{page:slug}', 'PagesController@destroy')->name('destroy');
    });
    Route::prefix('user')->name('user.')->group(function(){
        Route::get('', 'UserController@index')->name('index');
        Route::get('create', 'UserController@create')->name('create');
        Route::post('', 'UserController@store')->name('store');
        Route::get('{user:id}/edit', 'UserController@edit')->name('edit');
        Route::put('{user:id}', 'UserController@update')->name('update');
        Route::delete('{user:id}', 'UserController@destroy')->name('destroy');
    });

    Route::prefix('category')->name('category.')->group(function(){
        Route::get('', 'CategoryController@index')->name('index');
        Route::get('{category:slug}/down', 'CategoryController@shiftDown')->name('shiftDown');
        Route::get('{category:slug}/up', 'CategoryController@shiftUp')->name('shiftUp');
        Route::get('create', 'CategoryController@create')->name('create');
        Route::post('', 'CategoryController@store')->name('store');
        Route::get('{category:slug}/edit', 'CategoryController@edit')->name('edit');
        Route::put('{category:slug}', 'CategoryController@update')->name('update');
        Route::delete('{category:slug}', 'CategoryController@destroy')->name('destroy');
    });

    Route::prefix('ad')->name('ad.')->group(function(){
        Route::get('', 'AdController@index')->name('index');
        Route::get('create', 'AdController@create')->name('create');
        Route::post('', 'AdController@store')->name('store');
        Route::get('{ad:slug}/edit', 'AdController@edit')->name('edit');
        Route::put('{ad:slug}', 'AdController@update')->name('update');
        Route::delete('{ad:slug}', 'AdController@destroy')->name('destroy');
    });

    Route::prefix('sponsor')->name('sponsor.')->group(function (){
        Route::get('', 'SponsorController@index')->name('index');
        Route::get('create', 'SponsorController@create')->name('create');
        Route::get('{sponsor}/edit', 'SponsorController@edit')->name('edit');
        Route::post('', 'SponsorController@store')->name('store');
        Route::put('{sponsor}', 'SponsorController@update')->name('update');
        Route::delete('{sponsor}', 'SponsorController@destroy')->name('destroy');
    });


    Route::get('', 'DashboardController@index')->name('dashboard');

});

Route::get('/{page:slug}', '\App\Http\Controllers\admin\PagesController@show')->name('pages.show');


