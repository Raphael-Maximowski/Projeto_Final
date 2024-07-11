<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
        public function getAuthenticatedUser(Request $request)
        {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json($user, 200);
        }

        public function makeAdmin($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $user->is_admin = true;
        $user->save();

        return response()->json(['message' => 'O usuário foi atualizado para administrador'], 200);
    }

    public function search(Request $request)
    {

        $query = User::query(); // Inicializa uma consulta

        if ($request->has('name')) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('name') . '%')
                      ->orWhere('last_name', 'like', '%' . $request->input('name') . '%');
            });
        }

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        $users = $query->get();

        return response()->json(['users' => $users], 200);
    }
}

