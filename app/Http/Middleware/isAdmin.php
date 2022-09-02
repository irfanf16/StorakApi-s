<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
class isAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // NEED TO FIX THIS
        $user = User::find(auth()->id());

        // 1 IS THE user_role_id FOR ADMIN
        if ($user->user_role_id != 1) {
            return response()->json([
                "status" => 100,
                "errors" => ["Only Admin has access to this request."] 
            ]);
        }

        return $next($request);
    }
}