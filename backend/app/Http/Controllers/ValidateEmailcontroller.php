<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;

class ValidateEmailcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendVerificationLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = Auth::user();

        if ($user->email === $request->email && !$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            return response()->json(['message' => 'Link de verificação de email enviado com sucesso.'], 200);
        } else {
            return response()->json(['message' => 'Email já verificado ou não encontrado.'], 400);
        }
    }
}
