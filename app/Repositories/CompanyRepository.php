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

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function getByUser(User $user)
    {
        return Company::whereHas(
            'users',
            function ($query) use ($user) {
                $query->where('id', $user->id);
            },
        )->toSql();
    }

    /**
     * @param Company $company
     */
    public function save(Company $company)
    {
        $company->save();
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getById(int $id)
    {
        return Company::find($id);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $company = Company::find($id);
        $company->delete();
    }

    public function create(array $data)
    {
        Company::create($data);
    }

    public function paginate($perPage)
    {
        return Company::paginate($perPage);
    }
}
