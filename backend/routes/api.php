<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\AuthController;
use App\Models\User;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'crm', 'middleware'=> 'auth:sanctum'], function() {
    Route::post('logout', [AuthController::class, 'logout']);
});
Route::post('register',[AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Rota para a recuperção de senha 
Route::get('forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');


// Rota para verificar se o usuário está no banco de dados para enviar o email
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')   // Esta mandando o link
    );
 
    // Após o envio do link
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

 // Passando um token para a rota
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

// fazendo a validação para o update da senha
Route::post('/reset-password', function (Request $request) {
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
 
            event(new PasswordReset($user)); // manda um email para dizer que a senha foi alterada com sucesso
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');