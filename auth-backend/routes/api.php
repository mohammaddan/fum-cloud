<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('signup',[AuthController::class,'signup'])->name('signup');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::get('check',[AuthController::class,'check'])->name('check');

Route::middleware(AuthToken::class)->get('doctors',function (Request $request){
   return \App\Models\User::where('role',\App\Http\Classes\RoleType::DOCTOR)
    ->where(function($q) use($request){
        if(isset($request['doctor_no'])) $q->where('doctor_no',$request['doctor_no']);
    })->get();
});
