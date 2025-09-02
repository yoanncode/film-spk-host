<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::get('/', function () {
    return view('spkrekom.index');
});

Route::get('/recommend', [FilmController::class, 'recommend'])->name('recommend');
