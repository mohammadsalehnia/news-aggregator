<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private AuthService $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    public function register(RegisterUserRequest $request): JsonResponse
    {

        $validatedData = $request->validated();
        // Create a new user
        $user = $this->authService->addUser($validatedData);

        // Generate a token for the user
        $token = $user->createToken('ApiToken')->accessToken;

        return response()->json(['token' => $token], 201);
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        $user = $this->authService->findUserByEmail($request->email);

        if ($user && Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = $user->createToken('ApiToken')->accessToken;

            return response()->json([
                'status' => 'success',
                'message' => 'User logged in successfully',
                'token' => $token,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials',
        ], 401);
    }
}
