<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLog;

class LogController extends Controller
{
    public function index()
    {
        $logs = UserLog::with('user', 'contact')->orderBy('created_at', 'desc')->get();
        return response()->json($logs);
    }

    public function show($id)
    {
        $log = UserLog::with('user', 'contact')->findOrFail($id);
        return response()->json($log);
    }
}
