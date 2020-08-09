<?php

use Illuminate\Support\Facades\Route;

Route::prefix('live')->group(function (){
    Route::post('/', 'LiveController@store');
});