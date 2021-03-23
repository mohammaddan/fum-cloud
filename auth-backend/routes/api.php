<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthToken;
use Illuminate\Support\Facades\Route;


Route::post('signup',[AuthController::class,'signup'])->name('signup');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::get('check',[AuthController::class,'check'])->name('check');

Route::middleware(AuthToken::class)->get('doctors',function (){
   return \App\Models\User::where('role',\App\Http\Classes\RoleType::DOCTOR)->get();
});
