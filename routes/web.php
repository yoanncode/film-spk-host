<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::get('/recommend', [FilmController::class, 'recommend'])->name('recommend');

