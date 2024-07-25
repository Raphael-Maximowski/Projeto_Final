<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index($id)
    {
        $contacts = Contact::where('step_id', $id)->get();
        return response()->json($contacts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'posicao' => 'required|integer',
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|email',
            'cpf' => 'required|string|max:14',
            'data_de_nascimento' => 'required|string',
            'endereco' => 'required|string',
            'value' => 'required',
            'step_id' => 'required'
        ]);

        $contact = Contact::create($request->all());
        return response()->json($contact, 201);
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'posicao' => 'required|integer',
            'step_id' => 'exists:steps,id',
        ]);

        $novaPosicao = $request->posicao;
        $contact = Contact::findOrFail($id);
        $step_id = $request->step_id;
        $posicaoAtual = $contact->posicao;
        if ($novaPosicao == $posicaoAtual) {
            return response()->json($contact);
        }
        $rest = Contact::where('step_id', $step_id)->orderBy('posicao')->get();
        for ($i = 0; $i < count($rest); $i++) {
            if ($rest[$i]->id == $id) {
                continue;
            }
            if ($posicaoAtual < $novaPosicao) {
                if ($rest[$i]->posicao > $posicaoAtual && $rest[$i]->posicao <= $novaPosicao) {
                    $rest[$i]->posicao--;
                    $rest[$i]->save();
                }
            } else {
                if ($rest[$i]->posicao >= $novaPosicao && $rest[$i]->posicao < $posicaoAtual) {
                    $rest[$i]->posicao++;
                    $rest[$i]->save();
                }
            }
        }
        $contact->update(['posicao' => $novaPosicao]);
        return response()->json($contact);
    }

    public function updateOldStep(Request $request, $id)
    {
        $request->validate([
            'posicao' => 'required|integer',
            'step_id' => 'exists:steps,id',
        ]);

        $contact = Contact::findOrFail($id);
        $oldPosition = $contact->posicao;
        $oldStep = $contact->step_id;

        if ($oldPosition != $request->posicao || $oldStep != $request->step_id) {
            return response()->json(['message' => 'Etapa não encontrada'], 422);
        }

        $oldRest = Contact::where('step_id', $oldStep)->where('posicao', '>', $oldPosition)->orderBy('posicao')->get();

        for ($i = 0; $i < count($oldRest); $i++) {
            $oldRest[$i]->posicao--;
            $oldRest[$i]->save();
        }

        return response()->json(['message' => 'Etapa atualizada']);
    }

    public function updateNewStep(Request $request, $id)
    {
        $request->validate([
            'newStep_id' => 'required|exists:steps,id',
            'newPosition' => 'required|integer',
        ]);

        $contact = Contact::findOrFail($id);
        $newStep = $request->newStep_id;
        $newPosition = $request->newPosition;

        $newRest = Contact::where('step_id', $newStep)->where('posicao', '>', $newPosition)->orderBy('posicao')->get();

        for ($i = 0; $i < count($newRest); $i++) {
            $newRest[$i]->posicao++;
            $newRest[$i]->save();
        }

        $contact->step_id = $newStep;
        $contact->posicao = $newPosition;
        $contact->save();

        return response()->json($contact);
    }

    public function updateInfos (Request $request, $id)
    {
        $request->validate([
            'posicao' => 'sometimes|integer',
            'name' => 'sometimes|string',
            'phone' => 'sometimes|string',
            'email' => 'sometimes|string|email',
            'cpf' => 'sometimes|string|max:14',
            'data_de_nascimento' => 'sometimes',
            'endereco' => 'sometimes|string',
            'value' => 'sometimes',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return response()->json(['message' => 'Contato atualizado com sucesso', 'data' => $contact]);
    }

    public function destroy($id)
    {
        Contact::destroy($id);
        return response()->json(null, 204);


    }

    public function search(Request $request)
    {

        $query = Contact::query(); // Inicializa uma consulta

        if ($request->has('name')) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('name') . '%');
            });
        }

        $users = $query->get();

        return response()->json(['users' => $users], 200);
    }
}
