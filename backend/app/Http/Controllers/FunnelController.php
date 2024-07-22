<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Funnel;
use App\Models\Step;

class FunnelController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return Funnel::where('user_id', $user->id)->get(); // Retorna todos os funis do usuário
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'collection_id' => 'required|integer'
        ]);

        $user = Auth::user();

        $funnel = Funnel::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $user->id,
            'collection_id' => $request->collection_id, // Criação de um novo funil
        ]);

        $stepsName = ['Sem etapa', 'Prospecção', 'Contato', 'Proposta'];
        $stepsPosition = [1, 2, 3, 4];

        foreach ($stepsName as $index =>$stepsName){
            $step = new Step ([
                'name' => $stepsName,
                'posicao' => $stepsPosition[$index],
                'funnel_id' => $funnel->id,
            ]);

            $step->save();
        }

        return response()->json($funnel, 201);

    }

    public function show($id)
    {
        $user = Auth::user();

        $funnel = Funnel::where('id', $id)->where('user_id', $user->id)->firstOrFail(); // Busca um funil específico pelo ID
        return response()->json($funnel);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'description' => 'sometimes|string', // Validação dos campos para atualizar
        ]);

        $user = Auth::user();
        $funnel = Funnel::where('id', $id)->firstOrFail();

        $funnel->update($request->only(['name', 'description'])); // Busca e atualiza o funil pelo ID

        return response()->json($funnel, 200);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $funnel = Funnel::where('id', $id)->firstOrFail(); // Busca e deleta o funil pelo ID
        $funnel->delete();

        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $query = Funnel::where('user_id', $user->id); // inicia a consulta

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%'); // Aplicar filtros
        }

        $funnels = $query->get(); // Executar a busca

        return response()->json(['funnels' => $funnels], 200);
    }
}
