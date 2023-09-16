<?php 

    namespace App\Providers\Services\DataBaseServices;
    use App\Models\Faculty;

    class ReturnAllFacultiesAndSemestersServices
    {
        public function facultiesAndSemesters()
        {
            if(!(app('profile_service')->userProfile() === 'Student')){
                $faculties = Faculty::$faculties;
                $semesters = app('semesters_service')->allSemesters();
                return view('courses.register', compact('faculties', 'semesters'));
                }       
        
                return redirect('/home');
        }
    }