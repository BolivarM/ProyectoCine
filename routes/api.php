<?php

use App\pelicula;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/peliculas', 'PeliculasController@all');

Route::get('/peliculas/{id}', 'PeliculasController@show');

Route::post('/peliculas', 'PeliculasController@store');

Route::put('/peliculas/{id}', 'PeliculasController@update');

Route::delete('peliculas/{id}', 'PeliculasController@destroy');
