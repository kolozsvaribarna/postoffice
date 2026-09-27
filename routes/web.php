<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountiesController;
use App\Http\Controllers\CitiesController;

Route::resource('counties', CountiesController::class);
Route::resource('cities', CitiesController::class);

Route::get('/', fn () => redirect()->route('counties.index'));
