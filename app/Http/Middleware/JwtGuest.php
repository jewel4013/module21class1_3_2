<?php

namespace App\Http\Middleware;

use App\Helper\JwtToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class JwtGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            return redirect()->to('/profile'); // সরাসরি ড্যাশবোর্ডে পাঠিয়ে দাও
        }

        // লগইন না থাকলে নরমালি লগইন/রেজিস্টার পেজ দেখতে দাও
        return $next($request);
    }
}
