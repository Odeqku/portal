<?php

namespace App\Providers\Services\StudentServices;


class CompleteRegService
{
    public function reload()
    {               
        $profile = app('profile_service')->userProfile();        
        if($profile === 'Admin'){                
            return app('admin_page_services')->redirectToAdminPage();
        }        
        
        return app('student_page_services')->redirectToStudentPage();          
        
    }
}