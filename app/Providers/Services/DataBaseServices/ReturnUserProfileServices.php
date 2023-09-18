<?php

namespace App\Providers\Services\DataBaseServices;


class ReturnUserProfileServices
{
    public function userProfile()
    {   
        return app('users_service')->authUser()->profile->profileable_type;
    }
}