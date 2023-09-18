<?php

namespace App\Http\Controllers;
use App\Providers\Services\DataBaseServices\ReturnAllUsersServices;
use App\Providers\Services\StudentServices\CompleteRegService;
use App\Providers\Services\UserService;
use App\Providers\Services\ValidationServices\ValidateRegRequestServices;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(CompleteRegService $r)
    {           
        return $r->reload();            
    }

    public function register()
    {
        return view('courses.studentRegister');
    }

    public function store(Request $request, ReturnAllUsersServices $user, ValidateRegRequestServices $v)
    {           
        $user = $user ->authUser();
        $studentUser = $user->studentUser();
        $data = $v->validateRegRequest($request);

        $this->validate($request, $data);        
                     
        if($studentUser->details->isEmpty()){
            $fileNameToStore = app('save_image_services')->saveUploadedImage($request);        
        
            app('student_details_service')->createStudentDetails($request, $fileNameToStore);             
        }

        if($studentUser->kins->isEmpty()){
            
            app('student_next_of_kin_service')->createNextOfKin($request);
        }

        if($studentUser->guardians->isEmpty()){
            
           app('student_guardian_service')->createStudentGuardian($request);
        }

        if($studentUser->sponsors->isEmpty()){
            app('student_sponsor_service')->createStudentSponsor($request);
        }
         
        
        $levelCourses = $studentUser->level->course;
        $studentCourseIds = $studentUser->department                            
                            ->course_accesses
                            ->where('semester', $request['semester'])
                            ->pluck('course_id')                            
                            ->toArray(); 

        return view('courses.studentRegister', compact('levelCourses', 'studentCourseIds'));
    }


    public function storeStudentDetails(Request $request, ReturnAllUsersServices $user, ValidateRegRequestServices $v)
    {
        $studentUser = $user->studentUser();

        $this->validate($request, $v->data2);
    

        if($studentUser->details->isEmpty()){
            $fileNameToStore = app('save_image_services')->saveUploadedImage($request);

            app('student_details_service')->createStudentDetails($request, $fileNameToStore); 
        }

        if($studentUser->kins->isEmpty()){
            app('student_next_of_kin_service')->createNextOfKin($request);
        }

        if($studentUser->guardians->isEmpty()){
            app('student_guardian_service')->createStudentGuardian($request);
         }

         if($studentUser->sponsors->isEmpty()){
            app('student_sponsor_service')->createStudentSponsor($request);
        }

        return redirect('/home')->with('success', 'Details registered successfully');
    }
}