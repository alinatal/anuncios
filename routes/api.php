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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('deploy', function (Request $request){
    if($request->has('secret') && $request->secret == '7|P4zaudQ!4wV6kOW'){
        echo exec('php artisan fetch');
    }
    return $request->url();
    //else abort(response()->json('Unauthorized', 401));
});
