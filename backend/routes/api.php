<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Models\User;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'crm', 'middleware'=> 'auth:sanctum'], function() {
    
});
Route::post('register',[AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

