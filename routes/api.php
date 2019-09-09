<?php

use Illuminate\Http\Request;


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

    //authentication
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');

    //endpoints with auth
    Route::group(['prefix' => '/articles', 'middleware' => 'auth:api'], function(){
        Route::post('/', 'ArticleController@store');
        Route::put('/{id}', 'ArticleController@update');
        Route::delete('/{id}', 'ArticleController@delete');
    });
    //endpoints without auth
    Route::group(['prefix' => '/articles'], function(){
        Route::get('', 'ArticleController@index');
        Route::get('/{id}', 'ArticleController@show');
        Route::post('/{id}/rating', 'ArticleController@rating');
        Route::get('/search/{query}', 'ArticleController@search');
    });

