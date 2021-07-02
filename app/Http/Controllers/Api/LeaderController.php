<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Http\Request;

class LeaderController extends Controller
{
    public function index()
    {
        $leaders = Leader::active()
            ->get()
            ->pluck('name', 'id');

        return response()->json($leaders);
    }
}
