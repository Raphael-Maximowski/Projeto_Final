<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ValidateEmailcontroller extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Autentica o usuário
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Verifica se o e-mail do usuário está verificado
            if ($user->hasVerifiedEmail()) {
                // E-mail verificado, redireciona para o dashboard ou outra rota
                return redirect()->intended('/dashboard');
            } else {
                // E-mail não verificado, desloga o usuário
                Auth::logout();
                return back()->withErrors(['email' => 'Seu e-mail ainda não foi verificado.']);
            }
        }

        // Credenciais inválidas
        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ]);
    }
 }