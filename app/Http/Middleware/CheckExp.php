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
//        dd($request->user()->characters()->find(6));
        if ($request->user()->characters()->find($request->route()->parameters()['character'])->experience < 100) {
//            dd($request->user()->characters()->find($request->route()->parameters()['character'])->experience < 100);
            return redirect()->back();
        }
        return $next($request);
    }
}
