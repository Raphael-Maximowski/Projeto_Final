<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Funnel;

class FunnelController extends Controller
{
    public function index()
    { 
        return Funnel::where('user_id', Auth::id())->get(); // Retorna todos os funis do usuário 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'collection_id' => 'nullable|exists:collections,id', // Validação dos dados recebidos no request (collection_id é opcional)
        ]);

    
        $funnel = Funnel::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'collection_id' => $request->collection_id,  // Criação de um novo funil
        ]);

        return response()->json($funnel, 201);
    }

    public function show($id)
    {
        $funnel = Funnel::where('id', $id)->where('user_id', Auth::id())->firstOrFail();  // Busca um funil específico pelo ID
        return response()->json($funnel);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required',
            'description' => 'sometimes|required',  // Validação dos campos para atualizar
        ]);

        $funnel = Funnel::findOrFail($id);
        $funnel->update($request->only(['name', 'description'])); // Busca e atualiza o funil pelo ID

        return response()->json($funnel, 200);
    }

    public function destroy($id)
    {
        $funnel = Funnel::where('id', $id)->where('user_id', Auth::id())->firstOrFail(); // Busca e deleta o funil pelo ID
        $funnel->delete();

        return response()->json(null, 204);
    }

    public function search(Request $request)
{
    $query = Funnel::query(); // inicia a consulta

    if ($request->has('name')) { 
        $query->where('name', 'like', '%' . $request->input('name') . '%'); // Aplicar filtros
    }

    $funnels = $query->get(); // Executar a busca

    return response()->json(['funnels' => $funnels], 200);
}
}
