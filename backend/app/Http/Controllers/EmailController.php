<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\AuthController;
use App\Models\User;

class EmailController extends Controller
{   // Rota para verificar se o usuário está no banco de dados para enviar o email
    public function emailValidated(Request $request) {
        $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')   // Esta mandando o link
    );
    }
}
