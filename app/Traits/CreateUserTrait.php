<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait CreateUserTrait
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    private function validateUser(Request $request)
    {
        return Validator::make(
            $request->all(),
            [
                'name'     => 'required',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required',
            ]
        );
    }
}
