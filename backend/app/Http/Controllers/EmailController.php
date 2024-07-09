<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{   // Rota para verificar se o usuário está no banco de dados para enviar o email
    public function emailValidated(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')   // Esta mandando o link
        );

        // Após o envio do link
        return Password::RESET_LINK_SENT;   
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8',
        ]);

        $hashedToken = hash_hmac('sha256', $request->token, config('app.key'));
        dd($hashedToken);

        $passwordReset = DB::table('password_reset_tokens')->where('token', $hashedToken)->first();

        if (!$passwordReset) {
            return response()->json(['message' => 'Token inválido.'], 400);
        }

        $user = User::where('email', $passwordReset->email)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Senha redefinida com sucesso.'], 200);
    }

    };

