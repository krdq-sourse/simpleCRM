<?php

namespace App\Repositories\Interfaces;

use App\Models\Company;
use App\Models\User;

interface CompanyRepositoryInterfaces
{
    public function all();

    public function paginate($perPage);

    public function getById(int $id);

    public function getByUser(User $user);

    public function create(array $data);

    public function save(Company $company);

    public function delete(int $id);
}
