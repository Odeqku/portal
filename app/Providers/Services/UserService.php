<?php
namespace App\Providers\Services;


class UserService
{
    public function newUser($request)
    {
        
        if ($request['profile'] === 'Student') {
            $student_user = app('student_user_service');
            return $student_user->createStudentUser($request);
        }

        if ($request['profile'] === 'Admin') {
            $admin_user = app('admin_user_service');
            return $admin_user->createAdminUser($request);
        }        
    }    
}