<?php

    namespace App\Http\Middleware;

    use Closure;
    use JWTAuth;
    use Exception;
    use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

    class JwtMiddleware extends BaseMiddleware
    {
        /*
        |============================================================
        | NOTE-1 (PURPOSE OF MIDDLEWARE)
        |============================================================
        */
        public function handle($request, Closure $next)
        {
            try {
                $user = JWTAuth::parseToken()->authenticate();
                /*
                |============================================================
                | WE CAN EVEN FIND USER BY PARSING JWT TOKEN
                |============================================================
                |   $user = JWTAuth::parseToken($request->token)->authenticate();
                |
                |   return response()->json([
                |        'status' => 200,
                |        'user'   => $user
                |   ]);
                |
                */
            }
            catch (Exception $e) {

                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                    return response()->json([
                        "status"  => 400,
                        "message" => 'Token is Invalid',
                    ]);
                    // return response()->json(['status' => 'Token is Invalid']);
                }
                else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                    return response()->json([
                        "status"  => 401,
                        "message" => 'Token is Expired',
                    ]);
                    // return response()->json(['status' => 'Token is Expired']);

                }
                else{
                    return response()->json([
                        "status"  => 400,
                        "message" => 'Authorization Token not found',
                    ]);
                    // return response()->json(['status' => 'Authorization Token not found']);
                }
            }
            return $next($request);
        }

    }


    /*
    |============================================================
    | NOTE-1 (PURPOSE OF MIDDLEWARE)
    |============================================================
    | We can get token from every http request header and then
    | parse that token to check weather that token is valid,
    | expired or token not found. We can even use this token
    | to authenticate the login user as well.
    |
    */
