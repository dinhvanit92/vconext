<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function getMap()
    {
        $map = Map::where('id', 1)->get();
        return response()->json($map);
    }
    public function getMapWorkplace()
    {
        $map = Map::where('id', 2)->get();
        return response()->json($map);
    }
}
