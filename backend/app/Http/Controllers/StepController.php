<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function index()
    {
        $steps = Step::with('contacts')->get();
        return response()->json($steps);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'posicao' => 'required|integer',
            'funnel_id' => 'required|exists:funnels,id',
        ]);

        $step = Step::create($request->all());
        return response()->json($step, 201);
    }

    public function show($id)
    {
        $step = Step::with('contacts')->findOrFail($id);
        return response()->json($step);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'posicao' => 'integer',
            'funnel_id' => 'exists:funnels,id',
        ]);

        $step = Step::findOrFail($id);
        $step->update($request->all());
        return response()->json($step);
    }

    public function destroy($id)
    {
        Step::destroy($id);
        return response()->json(null, 204);
    }
}
