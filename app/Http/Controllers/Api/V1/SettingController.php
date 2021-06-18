<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => setting()->all(),
        ]);
    }
}
