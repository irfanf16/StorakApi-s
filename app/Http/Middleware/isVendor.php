<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;


class isVendor
{
    public function handle(Request $request, Closure $next)
    {
        // 2 IS THE user_role_id FOR VENDOR
        if (!(\Auth::user()->role_id == 2)) {
            return response()->json([
                'status'  => 403,
                'message' => 'You do not have permissions to access the requested resource',
            ]);
        }
        return $next($request);
    }
}