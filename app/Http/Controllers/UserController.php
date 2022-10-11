<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\UserRepositoryInterfaces;
use App\Traits\ValidateUserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ValidateUserTrait;

    private UserRepositoryInterfaces $userRepository;

    /**
     * @param UserRepositoryInterfaces $userRepository
     *
     * @return void
     */
    public function __construct(UserRepositoryInterfaces $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rowsPerPage = ($request->get('rowsPerPage') > 0)
            ? $request->get('rowsPerPage')
            : 0;

        $user = $rowsPerPage
            ? $this->userRepository->paginate($rowsPerPage)
            : $this->userRepository->all();

        return response($user->toJson(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validateUser = $this->validateUserCreate($request);

            if ($validateUser->fails()) {
                return $this->respondWithError($validateUser->errors());
            }

            $validated             = $validateUser->validated();
            $validated['password'] = Hash::make($validated['password']);

            $this->userRepository->create($validated);

            $response = $this->respondSuccess(
                __('user.created_successfully'),
            );
        } catch (\Throwable $throwable) {
            $response = $this->respondWentWrong($throwable);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user  = $this->userRepository->getById($id);
            $response = $this->respondSuccess(
                __('user.show_successfully'),
                [
                    'data' => $user->toJson(JSON_UNESCAPED_UNICODE),
                ]
            );
        } catch (\Throwable $throwable) {
            $response = $this->respondWentWrong($throwable);
        }

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        if (!$user) {
            abort(404);
        }
        return view('client.edit')->with(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $validateUser = $this->validateUserUpdate($request);
            if ($validateUser->fails()) {
                return $this->respondWithError($validateUser->errors());
            }
            $company = $this->userRepository->getById($id);
            $company->update($validateUser->validated());
            $response = $this->respondSuccess(__('messages.updated_successfully'));
        } catch (\Throwable $throwable) {
            $response = $this->respondWentWrong($throwable);
        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->userRepository->delete($id);
            $response = $this->respondSuccess(__('user.deleted_successfully'));
        } catch (\Throwable $throwable) {
            $response = $this->respondWentWrong($throwable);
        }
        return $response;
    }
}
