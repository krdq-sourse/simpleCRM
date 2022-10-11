<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\UserRepositoryInterfaces;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepositoryInterfaces $userRepository;

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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // todo сделать реквест
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
        $user = $this->userRepository->getById($id);
        return response($user->toJson(JSON_UNESCAPED_UNICODE), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //todo сделать вью
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //todo сделать реквест
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
