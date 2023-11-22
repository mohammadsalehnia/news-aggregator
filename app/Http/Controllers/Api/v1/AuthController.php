<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {

        $validatedData = $request->validated();
        // Create a new user
        $user = $this->userRepository->addUser($validatedData);


        // Generate a token for the user
        $token = $user->createToken('ApiToken')->accessToken;

        return response()->json(['token' => $token], 201);
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        $user = $this->userRepository->findByEmail($request->email);

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
