<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('signup',[AuthController::class,'signup'])->name('signup');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::get('check',[AuthController::class,'check'])->name('check');
