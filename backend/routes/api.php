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


//rotas coleção (preciso ver se posso adicionar elas no grupo acima para autenticar)

Route::get('collections', 'App\Http\Controllers\CollectionController@index');
Route::post('collections', 'App\Http\Controllers\CollectionController@store');
Route::get('collections/{id}', 'App\Http\Controllers\CollectionController@show');
Route::put('collections/{id}', 'App\Http\Controllers\CollectionController@update');
Route::delete('collections/{id}', 'App\Http\Controllers\CollectionController@destroy');

//rotas funil

Route::get('funnels', 'App\Http\Controllers\FunnelController@index');
Route::post('funnels', 'App\Http\Controllers\FunnelController@store');
Route::get('funnels/{id}', 'App\Http\Controllers\FunnelController@show');
Route::patch('funnels/{id}', 'App\Http\Controllers\FunnelController@update');
Route::delete('funnels/{id}', 'App\Http\Controllers\FunnelController@destroy');
