<?php

namespace App\Http\Middleware;

use Closure;

class CheckExp
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
        if ($request->user()->characters()->find(1)->experience < 100) {
//            dd($request->user()->characters()->find(1)->experience);
            return redirect()->back();
        }
        return $next($request);
    }
}
