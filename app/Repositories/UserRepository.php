<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\User;

class UserRepository implements Interfaces\UserRepositoryInterfaces
{

    public function all()
    {
        return User::all();
    }

    public function paginate($perPage)
    {
        return User::paginate($perPage);
    }

    public function getById(int $id)
    {
        return User::find($id);
    }

    public function getByCompany(Company $company)
    {
        return Company::whereHas(
            'companies',
            function ($query) use ($company) {
                $query->where('id', $company->id);
            },
        )->toSql();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function save(User $user)
    {
        $user->save();
    }

    public function delete(int $id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
