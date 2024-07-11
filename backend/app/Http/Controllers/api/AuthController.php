<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Enviar notificação de verificação de email
        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Usuário registrado com sucesso. Verifique seu email.'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user == null)
        {
            return response()->json(['message' => 'Usuario não Encontrado'], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        if (!$user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Verifique seu email para poder realizar o login'], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login executado com sucesso',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function verify(Request $request, $id, $hash)
    {
        // Localize o usuário pelo ID fornecido
        $user = User::findOrFail($id);

        // Verifique se o hash na URL é válido
        if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            return response()->json(['message' => 'Link de verificação inválido'], 403);
        }

        // Verifique o e-mail do usuário
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        //return response()->json(['message' => 'E-mail verificado']);
        return redirect('http://localhost:8085/')->with('message', 'E-mail verificado com sucesso. Faça login para continuar.');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'Logout executado com sucesso']);
    }
}
