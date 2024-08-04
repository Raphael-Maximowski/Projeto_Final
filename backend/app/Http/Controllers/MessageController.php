<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Messages;


class MessageController extends Controller
{
    public function show($user1, $user2) {
        $room = Messages::where(function($query) use ($user1, $user2) {
            $query->where('ID_FIRST', $user1)
                ->where('ID_SECOND', $user2);
        })
            ->orWhere(function($query) use ($user1, $user2) {
                $query->where('ID_FIRST', $user2)
                    ->where('ID_SECOND', $user1);
            })->first();

        return $room;
    }

    public function history($user1, $user2){
        $messages = [];
        $firstgetter = Messages::where(function($query) use ($user1, $user2) {
            $query->where('ID_FIRST', $user1)
                ->where('ID_SECOND', $user2);
        })->get();

        $secondgetter = Messages::where(function($query) use ($user1, $user2) {
            $query->where('ID_FIRST', $user2)
                ->where('ID_SECOND', $user1);
        })->get();

        for ($i = 0; $i < count($firstgetter); $i++) {
            array_push($messages, $firstgetter[$i]);
        }

        for ($i = 0; $i < count($secondgetter); $i++) {
            array_push($messages, $secondgetter[$i]);
        }

        usort($messages, function($a, $b) {
            return $a['id'] <=> $b['id'];
        });
        return $messages;

    }

}

