<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::all();
        return response()->json($funcionarios);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'admin_id' => 'required|exists:users,id',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        $funcionario = Funcionario::create($request->all());
        return response()->json($funcionario, 201);
    }

    public function show(Funcionario $funcionario)
    {
        return response()->json($funcionario);
    }

    public function update(Request $request, Funcionario $funcionario)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'admin_id' => 'sometimes|exists:users,id',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        $funcionario->update($request->all());
        return response()->json($funcionario);
    }

    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();
        return response()->json(null, 204);
    }
}
