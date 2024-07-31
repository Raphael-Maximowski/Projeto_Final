<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminUser;
use App\Models\Team;


class UserController extends Controller
{
        public function getAuthenticatedUser(Request $request)
        {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'Usuário não encontrado'], 404);
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

            if (!AdminUser::where('user_id', $user->id)->exists()) {

                AdminUser::create(['user_id' => $user->id]);
            }
            if (!Team::where('user_id', $user->id)->exists()) {}

            return response()->json(['message' => 'O usuário foi atualizado para administrador'], 200);
    }

    public function search(Request $request)
    {

        $query = User::query(); // Inicializa uma consulta

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        $users = $query->get();

        return response()->json(['users' => $users], 200);
    }

    public function profile($id)
    {
        $user =  User::FindOrFail($id);
        return response()->json(['user' => $user], 200);
    }
}

