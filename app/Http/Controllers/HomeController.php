<?php

namespace App\Http\Controllers;
use App\Models\GuardianDetails;
use App\Models\NextOfKinDetails;
use App\Models\PersonalDetails;
use App\Models\SponsorDetails;
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
    public function index()
    {      
        $complete_reg = app('complete_reg_service');
        return $complete_reg->reload();            
    }

    public function register()
    {
        return view('courses.studentRegister');
    }

    public function store(Request $request)
    {           
        $user = app('users_service') ->authUser();
        $studentUser = app('users_service')->studentUser();
        $data = app('validate_reg_request_services')->validateRegRequest($request);

        $this->validate($request, $data);        
                     
        if($studentUser->details->isEmpty()){
            $fileNameToStore = app('save_image_services')->saveUploadedImage($request);        
        
            app('student_details_service')->createStudentDetails($request, $fileNameToStore);             
        }

        if($studentUser->kins->isEmpty()){
            // dd('hello');
            app('student_next_of_kin_service')->createNextOfKin($request);
        }

        if($studentUser->guardians->isEmpty()){
            // dd('hiii');
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


    public function storeStudentDetails(Request $request)
    {
        $studentUser = app('users_service')->studentUser();

        $this->validate($request, app('validate_reg_request_services')->data2);
    

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