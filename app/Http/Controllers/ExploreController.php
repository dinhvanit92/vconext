<?php

namespace App\Http\Controllers;

use App\Models\Explore;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function getExplore()
    {
        $explore = Explore::all();
        return response()->json([
            'code' => 201,
            'data' => $explore
        ]);
    }
}
