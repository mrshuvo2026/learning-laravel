<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()){
            return redirect('/login');
        }
        if (auth()->user()->email !== 'shuvo@test.com'){
            return redirect('/dashboard');
        }
        if ($role !== 'admin'){
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
