<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Messages;


class MessageController extends Controller
{
    public function show($id) {
        $room = Messages::where('ID_FIRST', $id)
            ->orWhere('ID_SECOND', $id)
            ->first();

        return $room;
    }

    public function history($user1, $user2){
        $messages = [];
        $user1 = Messages::where('ID_FIRST', $user1)->get();
        for ($i = 0; $i < count($user1); $i++) {
            array_push($messages, $user1[$i]);
        }
        $user2 =  Messages::where('ID_FIRST', $user2)->get();
        for ($i = 0; $i < count($user2); $i++) {
            array_push($messages, $user2[$i]);
        }
        dd($messages);

    }

}

