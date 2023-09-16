<?php

namespace App\Providers\Services\StudentCoursesServices;
use App\Models\Level;
use App\Models\User;

class CompleteRegService
{
    public function reload()
    {
        $users = User::all();
        $authorizedUser = auth()->user();
        $profile = $authorizedUser->profile->profileable_type;
        if($profile === 'Admin'){                
            return view('pages.admin', compact('users', 'authorizedUser'));
        }
        
        $authorizedStudent = auth()->user()->student;
        $studentDetailsIsEmpty = $authorizedStudent->details->isEmpty();
        $studentDetailsNotEmpty = $studentDetailsIsEmpty;
        $levels = Level::all();
        $semesters = ['first semester', 'second semester'];
        
        //Note that course_student implies student_courses
        if(!$authorizedStudent->course_student->count()){                      
            
            return view('home', compact('studentDetailsIsEmpty', 'levels', 'semesters'))
            ->with('success', 'Personal Details Successfully Saved');
        }
        
        if($studentDetailsNotEmpty){                    
            return view('pages.registerDetails');
        }                   
                           
        return view('pages.studentDashboard');           
        
    }
}