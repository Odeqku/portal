<?php

namespace App\Providers\Services\DataBaseServices;
use App\Providers\Services\DataBaseServices\ReturnAllUsersServices;

class ReturnUserProfileServices extends ReturnAllUsersServices
{    
    public function userProfile()
    {   
        
        if($this->authUser()->hasRole('Student')){
            return 'Student';
        }

        if($this->authUser()->hasRole('Admin')){
            return 'Admin';
        }

        if($this->authUser()->hasRole('super admin')){
            return 'super admin';
        }
    }
}