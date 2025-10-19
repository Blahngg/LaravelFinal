<?php

use App\Http\Controllers\MusicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('sample');
});

Route::resource('/music', MusicController::class);
