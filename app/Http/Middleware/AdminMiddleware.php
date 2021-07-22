<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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

        if($request->user()->role === 'admin') {
            return $next($request);
        }

         return response()->json([
                'message'=>'You are not allowed to access.',
                'error'=>true
            ],400);

    }
}
