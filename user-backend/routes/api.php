<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\InfoController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;

Route::middleware(AuthCheck::class)->group(function (){
    Route::get('/me', [InfoController::class,'me']);
    Route::put('/info/{user_id}', [InfoController::class,'update']);
});

Route::get('/city',[CityController::class,'index']);
Route::middleware(AuthCheck::class)->delete('/favorite/{doctor_id}',[FavoriteController::class,'remove']);
Route::middleware(AuthCheck::class)->post('/favorite',[FavoriteController::class,'attach']);
Route::middleware(AuthCheck::class)->get('/favorite',[FavoriteController::class,'index']);
