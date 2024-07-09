<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funil;


class FunilController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'name'=> 'required|max:25',
            'description' => 'required|max:255',
        ]);
    }
}
