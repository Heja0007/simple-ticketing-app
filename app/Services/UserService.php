<?php

namespace App\Services;

use App\Interface\UserInterface;

class UserService
{
    protected UserInterface $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function getStaffs()
    {
        return $this->userInterface->getStaffs();
    }
}