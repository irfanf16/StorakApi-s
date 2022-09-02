<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class isBuyer
{
    public function handle(Request $request, Closure $next)
    {        
        // 3 IS THE user_role_id FOR Buyer
        if ((!Auth::user()) || (!Auth::user()->role_id == 3)) {
            return response()->json([
                'status'  => 401,
                'message' => 'Unauthorized - You do not have permissions to access the requested resource',
            ]);
        }
        return $next($request);
    }

}
