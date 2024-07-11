<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FunilController;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ValidateEmailcontroller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\UserController;




Route::middleware('auth:sanctum')->get('user', function (Request $request) {
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

Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

Route::post('email/send-verification', [ValidateEmailcontroller::class, 'sendVerificationLink']);

// a rota para mostrar o usuário autenticado
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);
});

Route::put('users/{id}/make-admin', [UserController::class, 'makeAdmin']);


//rotas coleção (preciso ver se posso adicionar elas no grupo acima para autenticar)
//Route::middleware('auth:sanctum')->group(function () {
    Route::get('collections', [CollectionController::class, 'index']); // Rota para listar todas as coleções 
    Route::post('collections', [CollectionController::class, 'store']);
    Route::get('collections/{id}', [CollectionController::class, 'show']);
    Route::put('collections/{id}', [CollectionController::class, 'update']);
    Route::delete('collections/{id}', [CollectionController::class, 'destroy']);
//});

//rotas funil

Route::middleware('auth:sanctum')->group(function () {
    Route::get('funnels', [FunnelController::class, 'index']); 
    Route::post('funnels', [FunnelController::class, 'store']);
    Route::get('funnels/{id}', [FunnelController::class, 'show']);
    Route::patch('funnels/{id}', [FunnelController::class, 'update']);
    Route::delete('funnels/{id}', [FunnelController::class, 'destroy']);

    Route::get('funnels/search', [FunnelController::class, 'search']); // Rota para busca de funis
});

Route::get('users/search', [UserController::class, 'search']);  // formas de usar no insomnia "users/search?name=nome,email ou sobrenome"

