<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function getPosition()
    {
        $position = Position::all();
        return response()->json([
            'code' => 201,
            'data' => $position
        ]);
    }
}
