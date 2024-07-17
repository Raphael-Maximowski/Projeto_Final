<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{   // Rota para verificar se o usuário está no banco de dados para enviar o email
    public function emailValidated(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')   // Esta mandando o link
        );

        if ($status == "passwords.user") {
            return response()->json(['message' => 'Usuario não Encontrado'], 404);
        }
        return response()->json(['message' => 'Password Reset Sent'], 200);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email'
        ]);

        $passwordReset = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        $validate = Hash::check($request->token, $passwordReset->token);

        if (!$validate) {
            return response()->json(['message' => 'Token inválido.'], 400);
        }

        $user = User::where('email', $passwordReset->email)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Senha redefinida com sucesso.'], 200);
    }

    };

