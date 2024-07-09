<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
        public function getAuthenticatedUser(Request $request, $authuser)
        {
            $user = User::find($authuser);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
    
            return response()->json($user, 200);
        }
}
