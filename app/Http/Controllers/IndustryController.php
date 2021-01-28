<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function getIndustry()
    {
        $industry = Industry::all();
        return response()->json([
            'code' => 201,
            'data' => $industry
        ]);
    }
}
