<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function index()
    {
        $campuses = Campus::active()
            ->get()
            ->pluck('name', 'id');

        return response()->json($campuses);
    }

    public function getLeaders(Campus $campus)
    {
        $leaders = $campus->leaders()
            ->orderBy('name')
            ->get()
            ->pluck('name', 'id');

        return response()->json($leaders);
    }
}
