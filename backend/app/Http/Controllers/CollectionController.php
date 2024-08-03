<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Collection;
use App\Models\Team;


class CollectionController extends Controller
{

    public function index($page = 1)
{
    $user = Auth::user();
    $itemsPerPage = 5; // itens por pag

    $teams = $user->teams;

    $collections = Collection::whereIn('team_id', $teams->pluck('id'))
        ->skip(($page - 1) * $itemsPerPage)
        ->take($itemsPerPage)
        ->get();

    $totalCollections = Collection::whereIn('team_id', $teams->pluck('id'))->count();
    $totalPages = ceil($totalCollections / $itemsPerPage);

    return response()->json([
        'current_page' => $page,
        'total_pages' => $totalPages,
        'collections' => $collections
    ]);
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'color' => 'required|string',
            'team_id' => 'required|integer'
        ]);

        $user = Auth::user();

        if (!$user->teams->contains($request->team_id)) {
            return response()->json(['message' => 'Usuário não pertence a este time'], 403);
        }

        $collection = Collection::create([
            'user_id' => $user->id,
            'team_id' => $request->team_id,
            'name' => $request->name,
            'description' => $request->description,
            'color' => $request->color
        ]);


        return response()->json($collection, 201);
    }

    public function show($id, Request $request)
    {
        $user = Auth::user();

        $collection = Collection::whereHas('team', function($query) use ($user) {
            $query->whereIn('teams.id', $user->teams->pluck('id'));
        })->where('id', $id)->first();

        if ($collection) {
            return response()->json($collection);
        } else {
            return response()->json(['message' => 'Coleção não encontrada'], 404);
        }
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'color' => 'required|string',
            'team_id' => 'required|integer|exists:teams,id'
        ]);

        $user = Auth::user();
        $collection = Collection::whereHas('team', function($query) use ($user) {
            $query->whereIn('teams.id', $user->teams->pluck('id'));
        })->where('id', $id)->first();

        if ($collection) {
            if (!$user->teams->contains($request->team_id)) {
                return response()->json(['message' => 'Usuário não pertence a este time'], 403);
            }

            $collection->update([
                'name' => $request->name,
                'description' => $request->description,
                'color' => $request->color,
                'team_id' => $request->team_id
            ]);

            return response()->json($collection, 200);
        } else {
            return response()->json(['message' => 'Coleção não encontrada'], 404);
        }
    }

    public function destroy($id, Request $request)
    {
        $user = Auth::user();

        $collection = Collection::whereHas('team', function($query) use ($user) {
            $query->whereIn('teams.id', $user->teams->pluck('id'));
        })->where('id', $id)->first();


        if ($collection) {
            $collection->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'Coleção não encontrada'], 404);
        }
    }
}
