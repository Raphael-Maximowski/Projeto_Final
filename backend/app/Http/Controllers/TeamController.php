<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;

class TeamController extends Controller
{
    public function index()
    {
        return Team::with('collections', 'users')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'admin_id' => 'required|integer',
        ]);
        $admin = AdminUser::findOrFail($request->admin_id);

        $company =  Empresa::where('admin_id', $admin->id)->first();
        $team = Team::create([
            'name' => $request->name,
            'description' => $request->description,
            'empresa_id' => $company->id,
        ]);
        return response()->json($team, 201);
    }

    public function show($id)
    {
        $team = Team::with('collections', 'users', 'funnels')->findOrFail($id);

        return response()->json($team);
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string' . $id,
            'description' => 'sometimes|string',
            'empresa_id' => 'sometimes|integer|exists:empresa,id',
        ]);

        $team = Team::findOrFail($id);
        $team->update($request->only(['name', 'description', 'empresa_id']));

        return response()->json($team, 200);
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return response()->json(null, 204);
    }

    public function addUserToTeam(Request $request, $teamId)
    {
            $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'team_id' => 'required|integer|exists:teams,id',
            ]);

            $team = Team::findOrFail($teamId);
            $user = User::findOrFail($request->user_id);

            // Atualiza o `team_id` do usuário
            $user->team_id = $request->team_id;
            $user->save();

            $team->users()->attach($user->id);

            return response()->json(['message' => 'Usuário adicionado ao time'], 200);
    }

    public function removeUserFromTeam($teamId, $userId)
    {

        $team = Team::findOrFail($teamId);
        $team->users()->detach($userId);

        return response()->json(['message' => 'Usuário removido do grupo'], 200);
    }

    public function addCollectionToTeam(Request $request, $teamId, $collectionId)
    {
        $team = Team::findOrFail($teamId);

        $request->validate([
            'collection_id' => 'required|integer|exists:collections,id'
        ]);

        $team->collections()->attach($collectionId);

        return response()->json(['message' => 'Coleção adicionada ao time'], 200);
    }

    public function removeCollectionFromTeam(Request $request, $teamId, $collectionId)
    {
        $team = Team::findOrFail($teamId);

        $request->validate([
            'collection_id' => 'required|integer|exists:collections,id'
        ]);

        $team->collections()->detach($collectionId);

        return response()->json(['message' => 'Coleção removida do time'], 200);
    }
}
