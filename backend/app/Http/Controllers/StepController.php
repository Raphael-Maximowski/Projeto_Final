<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function index($id)
    {
        $steps = Step::with('contacts')->where('funnel_id', $id)->get();
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

        $newPosition = $request->posicao;
        $step = Step::findOrFail($id);
        $funnelId = $request->funnel_id;
        $oldPosition = $step->posicao;

        if ($newPosition == $oldPosition) {
            return response()->json($step);
        }

        $rest = Step::where('funnel_id', $funnelId)->orderBy('posicao')->get();

        for ($i = 0; $i < count($rest); $i++) {
            if ($rest[$i]->id == $id) {
                continue;
            }
            if ($oldPosition < $newPosition) {
                if ($rest[$i]->posicao > $oldPosition && $rest[$i]->posicao <= $newPosition) {
                    $rest[$i]->posicao--;
                    $rest[$i]->save();
                }
            } else {
                if ($rest[$i]->posicao >= $newPosition && $rest[$i]->posicao < $oldPosition) {
                    $rest[$i]->posicao++;
                    $rest[$i]->save();
                }
            }
        }
        $step->update(['posicao' => $newPosition]);
        return response()->json($step);
    }

    public function destroy($id)
    {
        Step::destroy($id);
        return response()->json(null, 204);
    }
}
