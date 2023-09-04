<?php

namespace App;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Services\AuthService;


class Utilities
{
    public static function error($e)
    {
        Log::stack(['project'])->info($e->getMessage().' in '.$e->getFile().' at Line '.$e->getLine());
        return response()->json([
            'statusCode' => 500,
            'message' => 'An error occured while trying to perform this operation, Please try again later or contact support'
        ], 500);
    }

    public static function refreshToken($guard)
    {
        $authService = new AuthService;
        // $token = Auth::getToken();
        // Auth::guard('api')->get_token();
        // return $authService->refreshToken($token);
        return $authService->checkToRefreshToken($guard);
    }

    public static function ok($data)
    {
        return response()->json([
            'statusCode' => 200,
            'data' => $data,
            'token' => Utilities::refreshToken(Auth::guard('api'))
        ], 200);
    }
}