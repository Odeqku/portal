<?php

namespace App\Providers\Services\DataBaseServices;
use App\Models\User;

class ReturnUserProfileServices
{
    public function userProfile()
    {   
        return app('users_service')->authUser()->profile->profileable_type;
    }
}