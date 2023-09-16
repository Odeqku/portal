<?php

namespace App\Providers\Services\DataBaseServices;
use App\Models\User;

class ReturnUserProfileServices
{
    public function userProfile()
    {
        return auth()->user()->profile->profileable_type;
    }
}