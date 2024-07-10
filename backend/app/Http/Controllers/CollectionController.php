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
            'name' => 'required', 
            'description' => 'required' // Validação dos dados recebidos no request
        ]);

        $collection = Collection::create([
            'name' => $request->name,
            'user_id' => Auth::id(),  // Criação de uma nova coleção
        ]);

        return response()->json($collection, 201);
    }

    public function show($id)
    {
        $collection = Collection::where('id', $id)->where('user_id', Auth::id())->firstOrFail(); // Busca uma coleção específica pelo ID (autenticado)
        return response()->json($collection);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'   // Validação dos campos para atualização
        ]);

        $collection = Collection::findOrFail($id);
        $collection->update([
            'name' => $request->name,  // Busca e atualiza a coleção pelo ID
        ]);

        return response()->json($collection, 200);
    }

    public function destroy($id)
    {
        $collection = Collection::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $collection->delete(); // Busca e deleta a coleção pelo ID

        return response()->json(null, 204);
    }
}
