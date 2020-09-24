<?php

use Illuminate\Support\Facades\Route;

Route::prefix('live')->group(function (){
    Route::get('/', 'LiveController@list');
    Route::post('/', 'LiveController@store');
    Route::get('{id}', 'LiveController@show');
    Route::patch('{id}', 'LiveController@update');
    Route::delete('{id}', 'LiveController@destroy');
});
