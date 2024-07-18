<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
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
            'data_de_nascimento' => 'required|date',
            'endereco' => 'required|string',
            'value' => 'required|numeric',
            'step_id' => 'required|exists:steps,id',
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
            'posicao' => 'integer',
            'name' => 'string|max:255',
            'phone' => 'string|max:255',
            'email' => 'string|email|max:255',
            'cpf' => 'string|max:14',
            'data_de_nascimento' => 'date',
            'endereco' => 'string|max:255',
            'value' => 'numeric',
            'step_id' => 'exists:steps,id',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return response()->json($contact);
    }

    public function destroy($id)
    {
        Contact::destroy($id);
        return response()->json(null, 204);
    }
}
