<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;
use App\Models\Contact;


class StepController extends Controller
{
    public function index($id)
    {
        $steps = Step::with('contacts')->where('funnel_id', $id)->orderBy('posicao')->get();

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

        Contact::create([
            'name' => 'card vazio',
            'posicao' => 1,
            'phone' => '',
            'email' => '',
            'cpf' => '',
            'data_de_nascimento' => '',
            'endereco' => '',
            'value' => 0,
            'funnel_id' => $request->funnel_id,
        ]);

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
        $stepToDelete = Step::findOrFail($id);
        $positionToDelete = $stepToDelete->posicao;
        $stepToDelete->delete();

        Step::where('funnel_id', $stepToDelete->funnel_id)->where('posicao', '>', $positionToDelete)->decrement('posicao');

        return response()->json(null, 204);
    }

    public function editinfo(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $step = Step::findOrFail($id);
        $step->update(['name' => $request->name]);

        return response()->json(['message' => 'Nome Alterado', 'step' => $step], 200);
    }

}
