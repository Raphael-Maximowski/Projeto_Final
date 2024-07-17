<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Contact extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|integer',
            'cpf' =>'required|string',
            'dataNasc' => 'required|string',
            'endereco' => 'required|string',
            'value' => 'required|decimal'

        ]);

        $user = Auth::user();

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cpf' => $request->collection_id, 
        ]);

        return response()->json($contact, 201);
    }
}