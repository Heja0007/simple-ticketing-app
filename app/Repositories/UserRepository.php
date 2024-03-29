<?php

namespace App\Repositories;

use App\Interface\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getStaffs()
    {
        return $this->user->where('role', 'staff')->get();
    }
}