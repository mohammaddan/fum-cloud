<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthToken;
use Illuminate\Support\Facades\Route;


Route::post('signup',[AuthController::class,'signup'])->name('signup');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::middleware(AuthToken::class)
    ->get('check',[AuthController::class,'check'])->name('check');


//Route::middleware(AuthToken::class)->get('/user', function (Request $request) {
//    return \App\Models\User::all();
//});
