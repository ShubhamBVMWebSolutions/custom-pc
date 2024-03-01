<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/send-otp',[App\Http\Controllers\Auth\LoginController::class,'send_otp'])->name('api.send-otp');
Route::post('/get-pc-performances',[App\Http\Controllers\Admin\PcPerformanceController::class,'get_pc_performances'])->name('api.get-pc-performances');
