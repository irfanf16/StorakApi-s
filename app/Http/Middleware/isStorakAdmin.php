<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;


class isStorakAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!\Auth::user()) {
            return response()->json([
                'status'  => 401,
                'message' => 'You are Unauthorized to access the requested resource',
            ]);
        }

        // IF AUTH-USER IS NOT STORAK-ADMIN
        if (!(\Auth::id() == 1) || !(\Auth::user()->role_id == 1)) {
            return response()->json([
                'status'  => 403,
                'message' => 'You do not have permissions to access the requested resource',
            ]);
        }

        return $next($request);
    }

}