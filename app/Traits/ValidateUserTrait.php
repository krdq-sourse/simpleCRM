<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait ValidateUserTrait
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    private function validateUserCreate(Request $request)
    {
        return Validator::make(
            $request->all(),
            [
                'name'     => 'required|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required',
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    private function validateUserLogin(Request $request)
    {
        return Validator::make(
            $request->all(),
            [
                'email'    => 'required|email',
                'password' => 'required',
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    private function validateUserUpdate(Request $request)
    {
        return Validator::make(
            $request->all(),
            [
                'name'  => 'required|max:255',
                'email' => 'required|email',
            ]
        );
    }

}
