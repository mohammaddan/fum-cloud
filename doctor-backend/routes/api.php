<?php

use App\Http\Controllers\InfoController;
use App\Http\Controllers\VisitTimeController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/doctors',[InfoController::class,'index']);

Route::get('/doctor/{doctor_id}', [InfoController::class,'show']);

Route::post('/visitTime',[VisitTimeController::class,'getVisit']);
