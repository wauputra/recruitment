<?php

namespace App\Http\Routes;

use Dentro\Yalr\BaseRoute;
use Illuminate\Support\Facades\Route;

class ToDoRoute extends BaseRoute
{
    /**
     * Register routes handled by this class.
     *
     * @return void
     */
    public function register(): void
    {
        Route::get('/', 'App\Http\Controllers\TodoController@index');
        Route::post('/todo/add','App\Http\Controllers\TodoController@store');
        Route::delete('/todo/del/{todo}', 'App\Http\Controllers\TodoController@destroy');
        Route::post('/todo/add-detail','App\Http\Controllers\TodoController@storedetail');
        Route::get('/todo/detail/{todo}', 'App\Http\Controllers\TodoController@showDetail');
        Route::delete('/todo/detail/del/{todo}', 'App\Http\Controllers\TodoController@destroydetail');

        Route::patch('/todo/edit-detail/{todo}', 'App\Http\Controllers\TodoController@updatedetail');
    }
}
