<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Collection;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $collections = Collection::where('user_id', $user->id)->get(); // busca todas as coleções que pertencem ao usuário

        return response()->json($collections);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'color' => 'required|string'
        ]);

        $user = Auth::user();

        $collection = Collection::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description,
            'color' => $request->color
        ]);

        return response()->json($collection, 201);
    }

    public function show($id, Request $request)
    {
        $user = Auth::user();

        $collection = Collection::where('user_id', $user->id)->where('id', $id)->first();
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
            'color' => 'required|string'
        ]);

        $user = Auth::user();
        $collection = Collection::where('user_id', $user->id)->where('id', $id)->first();

        if ($collection) {
            $collection->update([
                'name' => $request->name,
                'description' => $request->description,
                'color' => $request->color
            ]);

            return response()->json($collection, 200);
        } else {
            return response()->json(['message' => 'Coleção não encontrada'], 404);
        }
    }

    public function destroy($id, Request $request)
    {
        $user = Auth::user();
        $collection = Collection::where('user_id', $user->id)->where('id', $id)->first();

        if ($collection) {
            $collection->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'Coleção não encontrada'], 404);
        }
    }
}
