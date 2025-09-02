<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::get('/', [FilmController::class, 'recommend']);
Route::get('/recommend', [FilmController::class, 'recommend'])->name('recommend');

