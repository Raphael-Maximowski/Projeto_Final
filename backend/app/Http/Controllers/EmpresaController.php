<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return response()->json($empresas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'razao' => 'required|string',
            'cnpj' => 'required|string',
            'inscri_estadual' => 'required|string',
            'fundacao' => 'required|string',
        ]);

        $empresa = Empresa::create($request->all());
        return response()->json($empresa, 201);
    }

    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);
        return response()->json($empresa);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'sometimes|string',
            'razao' => 'sometimes|string',
            'cnpj' => 'sometimes|string',
            'inscri_estadual' => 'sometimes|string',
            'fundacao' => 'sometimes|string',
        ]);

        $empresa = Empresa::findOrFail($id);
        $empresa->update($request->all());
        return response()->json($empresa);
    }

    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        return response()->json(null, 204);
    }
}
