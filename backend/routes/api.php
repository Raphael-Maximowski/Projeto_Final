<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Password;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'crm', 'middleware'=> 'auth:sanctum'], function() {
    Route::post('logout', [AuthController::class, 'logout']);
});
Route::post('register',[AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Rota para a recuperção de senha 
//* Route::get('forgot-password', function () {
    //return view('auth.forgot-password');
//})->middleware('guest')->name('password.request');


// Rota para verificar se o usuário está no banco de dados para enviar o email
Route::post('forget_password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')   // Esta mandando o link
    );

    // Após o envio do link
    return Password::RESET_LINK_SENT;
})->middleware('guest')->name('password.email');

// fazendo a validação para o update da senha
Route::post('reset_password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->password = Hash::make($password);
            $user->save();

        }
    );
 
    return Password::PASSWORD_RESET;
})->middleware('guest')->name('password.update');