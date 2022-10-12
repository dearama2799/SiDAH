<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class CekApiKeyMiddleware
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
        $apikey = $request->header('x-api-key');
        // dd($apikey);

        if ($apikey !="smkyaj") {
            return response()->json([
                "status" => "Error",
                "message" => "Invalid Api Key"
            ],401);
        }

        return $next($request);
    }
}
