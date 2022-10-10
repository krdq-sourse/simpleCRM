<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface CompanyRepositoryInterfaces
{
    public function all();

    public function getByUser(User $user);
}
