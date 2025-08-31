<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\filmcontroller;

Route::get('/', function () {
    return view('spkrekom.index');
});

Route::get('/recommend', [filmcontroller::class, 'recommend'])->name('recommend');
