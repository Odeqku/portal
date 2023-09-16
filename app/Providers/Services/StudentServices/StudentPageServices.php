<?php

namespace App\Providers\Services\StudentServices;
use App\Models\User;

class StudentPageServices
{
    public function redirectToStudentPage()
    {
        $authorizedStudent = app('users_service')->studentUser();
        $levels = app('levels_service')->allLevels();
        $semesters = app('semesters_service')->allSemesters();
        $studentDetailsIsEmpty = $authorizedStudent->details->isEmpty();        
        
        //Note that course_student implies student_courses
        //I have not registered my courses and student details...
        if(!$authorizedStudent->course_student->count()){                
            return view('home', compact('studentDetailsIsEmpty', 'levels', 'semesters'))
            ->with('success', 'Personal Details Successfully Saved');
        }
        
        // I have my courses registered but my details...
        if($studentDetailsIsEmpty){                    
            return view('pages.registerDetails');
        }                   
        
        //I have registered all my courses and filled my details...
        return view('pages.studentDashboard'); 
    }
}