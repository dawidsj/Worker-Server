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


Route::group(['middleware' => ['CORS']], function () {
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@authenticate');
    Route::get('test', 'BoardController@test');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('user', 'UserController@getAuthenticatedUser');
        Route::post('user/boards/owner', 'BoardController@getOwnerBoards');
        Route::post('user/boards/participant', 'BoardController@getParticipantBoards');
        Route::post('user/boards/content', 'BoardController@getBoardsContent');
        Route::post('user/boards', 'BoardController@createBoard');
    });
});

