<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReferenceCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReferenceCodeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $referenceCodes = ReferenceCode::all();
    }

    public function store(Request $request)
    {
        $referenceCode = new ReferenceCode;
        $referenceCode->code = $request->prefix . '-' . Str::random(8);
        $referenceCode->save();
        return $referenceCode->toJson();
    }
}
