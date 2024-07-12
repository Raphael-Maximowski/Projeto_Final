<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Collection;

class CollectionController extends Controller
{
    public function index()
    {
        return Collection::where('user_id', Auth::id())->get(); // Retorna todas as coleções do usuário autenticado
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'description' => 'required', // Validação dos dados recebidos no request
            'color' => 'required'
        ]);


        $collection = Collection::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'color' => $request->color
        ]);

        return response()->json($collection, 201);
    }

    public function show(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $id = request('id');
        $collection = Collection::where('user_id', $id)->get(); // Busca uma coleção específica pelo ID (autenticado)
        return response()->json($collection);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'color' => 'required'
        ]);

        $id = request('id');
        $collection = Collection::find($id);
        $collection->update([
            'name' => $request->name,
            'description' => $request->description,
            'color' => $request->color
        ]);

        return response()->json($collection, 200);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $id = request('id');
        $collection = Collection::find($id);
        $collection->delete();

        return response()->json(null, 204);
    }

}
