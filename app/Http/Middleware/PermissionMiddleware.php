<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class PermissionMiddleware
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
        $pathAllowed = ["logout", "tamu", "buku_tamu"];
        $method = $request->method(); 
        $path = $request->path();
        $roles = $request->user->roles;
        
        if ($roles == 2) {
            if ($method == "GET" && in_array($path, $pathAllowed)) {
                return $next($request);
            }
            else {
                return response()->json(
                    ["status" => "Error",
                    "message" => "Anda tidak diijinkan"], 403
                );
            }
        }
        return $next($request);
        



        // dd($path, $method);
        // dd($roles);
        // dd($request->user->toArray());
        
    }
}
