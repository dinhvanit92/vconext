<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RandomUserController extends Controller
{
    public function getUser()
    {
        $user = User::get()->all();
        $user = Arr::random($user, 9);
        return response()->json([
            'code' => 201,
            'data' => $user
        ]);
    }
}
