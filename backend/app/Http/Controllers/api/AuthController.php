<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function register(UserRequest $request) {

        $user = User::create([
            'name'=> request('name'),
            'email'=> request('email'),
            'password'=> Hash::make($request->password),
        ]);

        return response()->json(["User"=>$user]);

        }
        

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where("email", $request->email)->firstOrFail();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $token= $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "message" => 'Login sucess',
            "access_token" => $token,
            "token_type" => 'Bearer',
        ]);
    } 

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "message" => 'Logout successful',
        ]);
    }
}
