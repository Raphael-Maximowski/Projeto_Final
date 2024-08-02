<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;
use App\Models\UserLog;

class LogController extends Controller
{
    public function index()
    {
        $logs = UserLog::with('user', 'contact')->orderBy('created_at', 'desc')->get();
        $stepnames = [];
        foreach ($logs as $log) {
            $stepid = $log->new_step;
            if ($stepid == null) {
                $stepid = $log->old_step;
            }
            $step = Step::where('id', $stepid)->first();
            array_push($stepnames, $step);
        }
        $retornojson = [
            'logs' => $logs,
            'steps' => $stepnames
        ];
        return response()->json($retornojson);
    }

    public function show($id)
    {
        $log = UserLog::with('user', 'contact')->findOrFail($id);
        return response()->json($log);
    }
}
