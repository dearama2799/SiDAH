<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PhpParser\Node\Expr\New_;
use PHPUnit\Framework\Test;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('authorization');
        // dd($token);
        $key = 'secret';

        try {
            $getPayload = JWT::decode($token, new Key($key, 'HS256'));
            // dd($getPayload);

            // $user = User::find($getPayload->data->id);
            $user = User::where([
                'id'=>$getPayload->data->id,
                'token'=>$token
            ])->first();

            // dd($user->toArray());

            if ($user == null) {
                return response()->json([
                    "status" => "Error",
                    "message" => "Token tidak valid"
                ], 401);
            }
            // dd($user->toArray());

            $request->merge([
                "user"=>$user
            ]);

            return $next($request);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => "Error",
                "message" => $th->getMessage()
            ], 401);
        }

        // dd('test');
        // return $next($request);
    }
}
