<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
        public function getAuthenticatedUser(Request $request)
        {
            $user = $request->user();
            
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
    
            return response()->json($user, 200);
        }
}
