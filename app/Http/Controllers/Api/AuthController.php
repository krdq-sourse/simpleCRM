<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterfaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private UserRepositoryInterfaces $userRepository;

    public function __construct(UserRepositoryInterfaces $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name'     => 'required',
                    'email'    => 'required|email|unique:users,email',
                    'password' => 'required',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => __('validation.error'),
                    'errors'  => $validateUser->errors(),
                ], 401);
            }

            $validated             = $validateUser->validated();
            $validated['password'] = Hash::make($validated['password']);

            $user = $this->userRepository->create($validated);

            return response()->json([
                'status'  => true,
                'message' => __('user.created_successfully'),
                'token'   => $user->createToken("API TOKEN")->plainTextToken,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email'    => 'required|email',
                    'password' => 'required',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'user.validation_error',
                    'errors'  => $validateUser->errors(),
                ], 401);
            }

            $validated = $validateUser->validated();

            if (!Auth::attempt($validated)) {
                return response()->json([
                    'status'  => false,
                    'message' => __('user.login_error'),
                ], 401);
            }

            $user = $this->userRepository->getUserByEmail($validated['email']);

            return response()->json([
                'status'  => true,
                'message' => 'user.login_successfully',
                'token'   => $user->createToken("API TOKEN")->plainTextToken,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
