<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\LoginRequest;
use App\Services\UserService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;
    protected $userService;
    public function __construct(UserService $userService)
    { 
        $this->userService=$userService;
    }
   

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = [
            'user-agent'=>$request->header('user-agent'),
            'x-forwarded-for'=>$request->header('x-forwarded-for'),
            'email' => $request->email,
            'password' => $request->password
        
        ];

        if (! $token = auth()->attempt($credentials)) {
            return $this->apiResponse([],'Account is invalid',false,422);
        }

        return $this->respondWithToken($token);
    }
    public function register(CreateRequest $request){
        return $this->userService->create($request);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->apiResponse(auth()->user(),'User Info',true);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
