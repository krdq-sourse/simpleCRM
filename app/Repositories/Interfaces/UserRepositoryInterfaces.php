<?php

namespace App\Repositories\Interfaces;

use App\Models\Company;
use App\Models\User;

interface UserRepositoryInterfaces
{
    public function all();

    public function paginate($perPage);

    public function getById(int $id);

    public function getByCompany(Company $company);

    public function getUserByEmail(string $email);

    public function create(array $data);

    public function save(User $user);

    public function delete(int $id);
}
