<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role === 'admin'){
            return $next($request);
        }else{
              return redirect()->back()->with('toastr-error', 'Unauthorized! Only admins are allowed.');
        }
    }
}




