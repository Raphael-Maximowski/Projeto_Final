<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FunnelController;
use App\Http\Controllers\ValidateEmailcontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\ContactController;


Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});



Route::post('register',[AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('logout', [AuthController::class, 'logout']);
});


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
Route::middleware('auth:sanctum')->group(function () {
    Route::get('collections', [CollectionController::class, 'index']);
    Route::get('/collections/page/{page}', [CollectionController::class, 'index']);
    Route::post('collections', [CollectionController::class, 'store']);
    Route::get('collections/{id}', [CollectionController::class, 'show']);
    Route::put('collections/{id}', [CollectionController::class, 'update']);
    Route::delete('collections/{id}', [CollectionController::class, 'destroy']);
});

//rotas funil

Route::middleware('auth:sanctum')->group(function () {
    Route::get('funnels', [FunnelController::class, 'index']);
    Route::post('funnels', [FunnelController::class, 'store']);
    Route::get('funnels/{id}', [FunnelController::class, 'show']);
    Route::patch('funnels/{id}', [FunnelController::class, 'update']);
    Route::delete('funnels/{id}', [FunnelController::class, 'destroy']);
    Route::post('funnels/search', [FunnelController::class, 'search']);
});

Route::get('users/search', [UserController::class, 'search']);  // formas de usar no insomnia "users/search?name=nome,email ou sobrenome"

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('teams')->group(function () {
        Route::get('', [TeamController::class, 'index']);
        Route::post('', [TeamController::class, 'store']);
        Route::get('/{id}', [TeamController::class, 'show']);
        Route::put('/{id}', [TeamController::class, 'update']);
        Route::delete('/{id}', [TeamController::class, 'destroy']);

        Route::post('/{teamId}/add-user', [TeamController::class, 'addUserToTeam']);
        Route::delete('/{teamId}/remove-user/{userId}', [TeamController::class, 'removeUserFromTeam']);

        Route::post('/{teamId}/add-collection/{collectionId}', [TeamController::class, 'addCollectionToTeam']);
        Route::delete('/teams/{teamId}/remove-collection/{collectionId}', [TeamController::class, 'removeCollectionFromTeam']);


    });
});

Route::middleware('auth:sanctum')->group(function () {
    // Rotas para etapas
    Route::post('steps', [StepController::class, 'store']);
    Route::get('steps/{id}', [StepController::class, 'index']);
    Route::patch('steps/{id}', [StepController::class, 'update']);
    Route::delete('steps/{id}', [StepController::class, 'destroy']);

    // Rotas para contatos
    Route::get('contacts/{id}', [ContactController::class, 'index']);
    Route::post('contacts', [ContactController::class, 'store']);
    Route::get('contact/{id}', [ContactController::class, 'show']);
    Route::patch('contacts/{id}', [ContactController::class, 'update']);
    Route::patch('contacts/cross/{id}', [ContactController::class, 'updateStep']);
    Route::delete('contacts/{id}', [ContactController::class, 'destroy']);
    Route::post('contacts/search', [ContactController::class, 'search']);
});
