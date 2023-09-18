<?php

namespace App\Http\Controllers;
use App\Providers\Services\DataBaseServices\ReturnAllUsersServices;
use App\Providers\Services\ImageFileServices\SaveImageServices;
use App\Providers\Services\StudentServices\CompleteRegService;
use App\Providers\Services\StudentServices\StudentGuardianDetailsService;
use App\Providers\Services\StudentServices\StudentNextOfKinsService;
use App\Providers\Services\StudentServices\StudentPersonalDetailsService;
use App\Providers\Services\StudentServices\StudentSponsorService;
use App\Providers\Services\ValidationServices\ValidateRegRequestServices;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    private $sImg;
    private $stdD;
    private $stdNxt;
    private $stdG;
    private $stdSp;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SaveImageServices $sImg, StudentPersonalDetailsService $stdD, StudentNextOfKinsService $stdNxt, StudentGuardianDetailsService $stdG, StudentSponsorService $stdSp)
    {
        $this->middleware('auth');
        $this->sImg = $sImg;
        $this->stdD = $stdD;
        $this->stdNxt = $stdNxt;
        $this->stdG = $stdG;
        $this->stdSp = $stdSp;
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
        $studentUser = $user->studentUser();
        $data = $v->validateRegRequest($request);

        $this->validate($request, $data);        
                     
        if($studentUser->details->isEmpty()){
            $fileNameToStore = $this->sImg->saveUploadedImage($request);        
        
            $this->stdD->createStudentDetails($request, $fileNameToStore);             
        }

        if($studentUser->kins->isEmpty()){            
            $this->stdNxt->createNextOfKin($request);
        }

        if($studentUser->guardians->isEmpty()){
            
           $this->stdG->createStudentGuardian($request);
        }

        if($studentUser->sponsors->isEmpty()){
            $this->stdSp->createStudentSponsor($request);
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
            $fileNameToStore = $this->sImg->saveUploadedImage($request);

            $this->stdD->createStudentDetails($request, $fileNameToStore); 
        }

        if($studentUser->kins->isEmpty()){
            $this->stdNxt->createNextOfKin($request);
        }

        if($studentUser->guardians->isEmpty()){
            $this->stdG->createStudentGuardian($request);
         }

         if($studentUser->sponsors->isEmpty()){
            $this->stdSp->createStudentSponsor($request);
        }

        return redirect('/home')
        ->with('success', 'Details registered successfully');
    }
}