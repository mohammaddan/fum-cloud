<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\InfoController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(AuthCheck::class)->group(function (){
    Route::get('/me', [InfoController::class,'me']);
    Route::put('/info/{user_id}', [InfoController::class,'update']);
});

Route::get('/city',[CityController::class,'index']);
