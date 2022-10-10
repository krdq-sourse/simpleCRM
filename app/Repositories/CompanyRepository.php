<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Interfaces\CompanyRepositoryInterfaces;

class CompanyRepository implements CompanyRepositoryInterfaces
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Company::all();
    }

    public function getByUser(User $user)
    {
        return Company::whereHas(
            'users',
            function ($query) use ($user) {
                $query->where('id', $user->id);
            },
        )->toSql();
    }
}
