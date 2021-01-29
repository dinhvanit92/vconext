<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->user()->id == 1) {
            return $next($request);
        }

        return response()->json([
            'code' => 403,
            'message' => 'Khong co quyen truy cap'
        ], 403);
    }
}
