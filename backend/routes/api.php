<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\EmailController;
use App\Models\User;
use Illuminate\Support\Facades\Password;  
use App\Http\Controllers\ValidateEmailcontroller;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'crm', 'middleware'=> 'auth:sanctum'], function() {
    Route::post('logout', [AuthController::class, 'logout']);
});
Route::post('register',[AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Rota para verificar se o usuário está no banco de dados para enviar o email
Route::post('forget_password', [EmailController::class, 'emailValidated'])
    ->middleware('guest')
    ->name('forget_password');

// fazendo a validação para o update da senha
Route::post('reset_password', [EmailController::class, 'resetPassword'])
->middleware('guest')
->name('password.update');

// Rota de validação de email
Route::post('email/verify', [ValidateEmailcontroller::class, 'verifyEmail'])
->middleware('guest') 
->name('verification.verify');

