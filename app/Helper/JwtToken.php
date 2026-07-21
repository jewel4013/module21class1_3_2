<?php

namespace App\Helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Log;

class JwtToken
{
    // jwt token create
    public static function createToken(array $userData, int $exp): array
    {
        try {
            $key = config('jwt.jwt_key');
            $payload = $userData + [
                'iss' => config('app.name'),
                'iat' => time(),
                'exp' => $exp,
            ];

            $token = JWT::encode($payload, $key, 'HS512');
            return [
                'error' => false,
                'message' => 'Token Created',
                'token' => $token,
            ];
        } catch (\Exception $e) {
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return [
                'error' => true,
                'message' => 'Token Error', 
                'token' => '',
            ];
        }
    }


    // jwt token verify
    public static function verifyToken(string $token): array
    {
        try {
            $key = config('jwt.jwt_key');
            if(!$token) {
                return [
                    'error' => true,
                    'payload' => [],
                    'message' => 'Token Required', 
                ];
            }
            $payload = JWT::decode($token, new Key(($key), 'HS512'));
            return [
                'error' => false,
                'payload' => $payload,
                'message' => 'Token Verified',
            ];
        } catch (\Exception $e) {
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return [
                'error' => true,
                'payload' => [],
                'message' => 'Token Error', 
            ];
        }
    }

}