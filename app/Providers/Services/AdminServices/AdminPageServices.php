<?php

namespace App\Providers\Services\AdminServices;

class AdminPageServices
{
    public function redirectToAdminPage()
    {
        $users = app('users_service')->allUsers();
        $authorizedUser = app('users_service')->authUser();      
                       
        return view('pages.admin', compact('users', 'authorizedUser')); 
        
    }
}