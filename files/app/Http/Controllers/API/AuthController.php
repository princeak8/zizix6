<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Http\Resources\UserResource;

use App\Http\Requests\Login;

use App\Services\AuthService;

class AuthController extends Controller
{
    


    public function login(Login $request)
    {
        $authService = new AuthService;
        $credentials = $request->only('email', 'password');
        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'statusCode' => 402,
                'message' => 'Wrong Username or Password'
            ], 402);
        }
        $ttl = auth('api')->factory()->getTTL();
        $authService->storeTokenExpiry($ttl);
        $user = new UserResource(auth::guard('api')->user());
        return response()->json([
            'statusCode' => 200,
            'data' => [
                        'token' => $token,
                        'token_type' => 'bearer',
                        'token_expires_in' => $ttl, 
                        'user' => $user
                    ]
        ], 200);
    }

    //AuthController
// public function token(){
//     $token = Auth::getToken();
//     if(!$token){
//         throw new BadRequestHtttpException('Token not provided');
//     }
//     try{
//         $token = JWTAuth::refresh($token);
//     }catch(TokenInvalidException $e){
//         throw new AccessDeniedHttpException('The token is invalid');
//     }
//     return $this->response->withArray(['token'=>$token]);
// }

}
