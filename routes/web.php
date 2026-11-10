<?php

use App\Http\Controllers\StaticPagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StaticPagesController::class, 'home']);
Route::get('/help', [StaticPagesController::class, 'help']);
Route::get('/about', [StaticPagesController::class, 'about']);
