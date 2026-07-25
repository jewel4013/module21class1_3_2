<?php

namespace App\Http\Middleware;

use App\Helper\JwtToken;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            if(!$request->cookie('userToken')){
                if($request->expectsJson()){
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthenticated',
                    ], 401);
                }            
                return redirect()->route('loginView');
            }else{
                $decoded = JwtToken::verifyToken($request->cookie('userToken'));
                if($decoded['error']){
                    return response()->json([
                        'status' => false,
                        'message' => $decoded['message'],
                    ], 401);
                }
                $payload = $decoded['payload'];
                $user = User::where('id', $payload->id)
                ->where('email', $payload->email)            
                ->first();

                Auth::login($user);

                return $next($request);
            }
        }catch(\Exception $e){
            Log::critical($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
            ], 401);
        }
                 
    }
}
