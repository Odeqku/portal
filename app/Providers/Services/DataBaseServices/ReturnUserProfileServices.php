<?php

namespace App\Providers\Services\DataBaseServices;
use App\Providers\Services\DataBaseServices\NewUserService;

class ReturnUserProfileServices
{
    
    public function userProfile()
    {   
        // dd('UserProfile');
        return app('users_service')->authUser()->profile->profileable_type;
        // if($user->authUser()->hasRole('Student')){
        //     return 'Student';
        // }

        // if($user->authUser()->hasRole('Admin')){
        //     return 'Admin';
        // }

        // if($user->authUser()->hasRole('super admin')){
        //     return 'super admin';
        // }
    }
}