<?php

namespace App\Http\Controllers;

use App\Models\Workplace;
use Illuminate\Http\Request;

class WorkplaceController extends Controller
{
    public function getWorkplace()
    {
        $workplace = Workplace::all();
        return response()->json([
            'code' => 201,
            'data' => $workplace
        ]);
    }
}
