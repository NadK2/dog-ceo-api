<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'breed'], function () {
    Route::get('/', [App\Http\Controllers\BreedController::class, 'index']);
    Route::get('/random', [App\Http\Controllers\BreedController::class, 'random']);
    Route::get('/{breed}', [App\Http\Controllers\BreedController::class, 'show']);
    Route::get('/{breed}/image', [App\Http\Controllers\BreedController::class, 'image']);
    Route::get('/{breed}/details', [App\Http\Controllers\BreedController::class, 'details']);
});

Route::post('/user/{user}/associate', [App\Http\Controllers\UserController::class, 'associate']);
Route::post('/park/{park}/breed', [App\Http\Controllers\ParkController::class, 'associateBreed']);
