<?php 

    namespace App\Providers\Services\DataBaseServices;


    class ReturnAllCoursesAndDepartmentsServices

    {
        public function coursesAndDepartments()
        {
            // dd('CoursesAndDepartments');
            if(!(app('profile_service')->userProfile() === 'Student')){
                // dd('CoursesAndDepartments1');
                $courses = app('courses_service')->allCourses();                
                $departments = app('departments_service')->allDepartments();
                
                return view('courses.show', compact('courses', 'departments'));
                
            }
    
                return redirect('/home');
        }
    }