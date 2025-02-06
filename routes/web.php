<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MovieController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('movies', MovieController::class);
    Route::post('movies/{movie}/publish', [MovieController::class, 'publish'])
        ->name('movies.publish');
});
