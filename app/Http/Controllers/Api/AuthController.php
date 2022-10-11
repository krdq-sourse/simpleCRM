<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ValidateUserTrait;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterfaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ValidateUserTrait;

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
            $validateUser = $this->validateUserCreate($request);

            if ($validateUser->fails()) {
                return $this->respondWithError($validateUser->errors());
            }

            $validated             = $validateUser->validated();
            $validated['password'] = Hash::make($validated['password']);

            $user = $this->userRepository->create($validated);

            $response = $this->respondSuccess(
                __('user.created_successfully'),
                [
                    'token' => $user->createToken("API TOKEN")->plainTextToken,
                ]
            );
        } catch (\Throwable $throwable) {
            $response = $this->respondWentWrong($throwable);
        }

        return $response;
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = $this->validateUserLogin($request);

            if ($validateUser->fails()) {
                return $this->respondWithError($validateUser->errors());
            }

            $validated = $validateUser->validated();

            if (!Auth::attempt($validated)) {
                return $this->respondWithError(__('user.login_error'));
            }

            $user = $this->userRepository->getUserByEmail($validated['email']);

            $response = $this->respondSuccess(
                __('user.login_successfully'),
                [
                    'token' => $user->createToken("API TOKEN")->plainTextToken,
                ]
            );
        } catch (\Throwable $throwable) {
            $response = $this->respondWentWrong($throwable);
        }

        return $response;
    }
}
