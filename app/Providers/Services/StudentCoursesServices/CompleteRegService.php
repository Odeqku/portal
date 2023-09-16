<?php

namespace App\Providers\Services\StudentCoursesServices;


class CompleteRegService
{
    public function reload()
    {               
        $profile = app('profile_service')->userProfile();        
        if($profile === 'Admin'){                
            return app('admin_services')->redirectToAdminPage();
        }        
        
        return app('student_page_services')->redirectToStudentPage();          
        
    }
}