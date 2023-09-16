<?php

namespace App\Providers\Services\DataBaseServices;
use App\Models\User;

class ReturnAllUsersServices
{
    public function allUsers()
    {
        return User::all();
    }

    public function authUser()
    {
        return auth()->user();
    }

    public function studentUser()
    {
        return $this->authUser()->student;
    }

}