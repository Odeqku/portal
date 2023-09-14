<?php

namespace App\Http\Controllers;

use App\Models\CourseAccess;
use App\Models\Department;
use App\Models\GuardianDetails;
use App\Models\Lecturer;
use App\Models\NextOfKinDetails;
use App\Models\PersonalDetails;
use App\Models\SponsorDetails;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Course;
use App\Models\Admin;
use App\Models\User;

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
        // dd('HomeController');
        
        $users = User::all();
        $authorizedUser = auth()->user();
        $profile = $authorizedUser->profile->profileable_type;

        try{
            
            if(!$authorizedUser->student->course_student->count()){
                // dd('hui');
                $studentDetailsIsEmpty = $authorizedUser->student->details->isEmpty();
                $levels = Level::all();
                $semesters = ['first semester', 'second semester'];

                return view('home', compact('studentDetailsIsEmpty', 'levels', 'semesters'))->with('success', 'Personal Details Successfully Saved');

            }elseif($profile === 'Admin'){
                
                return view('pages.admin');
            }else{
                // dd("////");
                if($authorizedUser->student->details->isEmpty()){
                    // dd("////");
                    return view('pages.registerDetails');
                }
                // dd('hii');
                return view('pages.studentDashboard');
            }
        
        }catch(\Exception $e){
            if($profile === 'Admin'){
                return view('pages.admin', compact('users', 'authorizedUser'));
            }
            dd('hi');
            return view('pages.studentDashboard');
        }
    }

    public function register()
    {
        return view('courses.studentRegister');
    }

    public function store(Request $request)
    {   
        $user = auth()->user();  

        if($user->student->details->isEmpty() && $request->has('level')){

            $this->validate($request, [
            'matric_number' => 'required',
            'semester' => 'required',
            'level' => 'required',

            // Personal Details
            'sex' => 'required',
            'state_of_origin' => 'required',
            'LGA_of_origin' => 'required',
            'date_of_birth' => 'required',
            'telephone' => 'required',
            'home_address' => 'required',
            'photograph' => 'required',

            // Next of Kin's Details
            'name' => 'required',
            'address' => 'required',
            'relationship' => 'required',
            'phone' => 'required',
            'email' => 'required',

            // Guardian's Details
            'guardian_name' => 'required',
            'guardian_address' => 'required',
            'guardian_telephone' => 'required',
            'guardian_email' => 'required',

            //Sponsor's Details
            'sponsor_name' => 'required',
            'sponsor_address' => 'required',
            'sponsor_telephone' => 'required',
            'sponsor_email' => 'required'
            ]);

        }else{
            $this->validate($request, [
                'matric_number' => 'required',
                'semester' => 'required',
                'level' => 'required',
            ]);
        }
        // dd('');
        $studentDetailsRequest = $request;
        // session(['studentDetailsRequest' => $request]);
        
        $studentId= $user->student->id;
        
        if($user->student->details->isEmpty()){
            if($request->hasFile('photograph')){
                //get filename with the extention 
                $filenameWithExt = $request->file('photograph')->getClientOriginalName();
                
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                
                // get just ext
                $extension = $request->file('photograph')->getClientOriginalExtension();
            
                //filename to store
                $fileNameToStore = $filename . '_'. time(). '.' . $extension;
            
                //
                $path = $request->file('photograph')->storeAs('public/studentPhoto',$fileNameToStore);
            }else{
                
                $fileNameToStore = 'noimage.jpg';
            }

        
            $newPersonalDetails = PersonalDetails::firstOrCreate([
                'student_id' => $studentId,
                'sex' => $request['sex'],
                'state_of_origin' => $request['state_of_origin'],
                'LGA_of_origin' => $request['LGA_of_origin'],
                'date_of_birth' => $request['date_of_birth'],
                'telephone' => $request['telephone'],
                'home_address' => $request['home_address'], 
                'photograph' => $fileNameToStore,
            ]);
        }

        if($user->student->kins->isEmpty()){
            $newNextOfKinDetails = NextOfKinDetails::firstOrCreate([
                'student_id' => $studentId,
                'name' => $request['name'],
                'address' => $request['address'],
                'relationship' => $request['relationship'],
                'phone' => $request['phone'],
                'email' => $request['email'],
            ]);
        }

        if($user->student->guardians->isEmpty()){
            $newGuardianDetails = GuardianDetails::firstOrCreate([
                'student_id' => $studentId,
                'guardian_name' => $request['guardian_name'],
                'guardian_address' => $request['guardian_address'],
                'guardian_telephone' => $request['guardian_telephone'],
                'guardian_email' => $request['guardian_email'],
            ]);
        }

        if($user->student->sponsors->isEmpty()){
            $newSponsorDetails = SponsorDetails::firstOrCreate([
                'student_id' => $studentId,
                'sponsor_name' => $request['sponsor_name'],
                'sponsor_address' => $request['sponsor_address'],
                'sponsor_telephone' => $request['sponsor_telephone'],
                'sponsor_email' => $request['sponsor_email'],
            ]);
        }
        
        $student = $user->student;  
              
        $levelCourses = $student->level->course;
        $studentCourseIds = $student->department                            
                            ->course_accesses
                            ->where('semester', $request['semester'])
                            ->pluck('course_id')                            
                            ->toArray(); 

        // dd(auth()->user()->student->course_student);

    // if($student->course)
        return view('courses.studentRegister', compact('levelCourses', 'studentCourseIds'));
    }


    public function storeStudentDetails(Request $request)
    {
        // dd('_-_-_');
        $user = auth()->user();
        $this->validate($request, [
                    
            // Personal Details
            'sex' => 'required',
            'state_of_origin' => 'required',
            'LGA_of_origin' => 'required',
            'date_of_birth' => 'required',
            'telephone' => 'required',
            'home_address' => 'required',
            'photograph' => 'required',

            // Next of Kin's Details
            'name' => 'required',
            'address' => 'required',
            'relationship' => 'required',
            'phone' => 'required',
            'email' => 'required',

            // Guardian's Details
            'guardian_name' => 'required',
            'guardian_address' => 'required',
            'guardian_telephone' => 'required',
            'guardian_email' => 'required',

            //Sponsor's Details
            'sponsor_name' => 'required',
            'sponsor_address' => 'required',
            'sponsor_telephone' => 'required',
            'sponsor_email' => 'required'
            ]);
    
    
            // dd('_-_-_.');
        $studentId= $user->student->id;
    
        //Process the image

        if($user->student->details->isEmpty()){
            if($request->hasFile('photograph')){
                //get filename with the extention 
                $filenameWithExt = $request->file('photograph')->getClientOriginalName();
                
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                
                // get just ext
                $extension = $request->file('photograph')->getClientOriginalExtension();
            
                //filename to store
                $fileNameToStore = $filename . '_'. time(). '.' . $extension;
            
                //
                $path = $request->file('photograph')->storeAs('public/studentPhoto',$fileNameToStore);
            }else{
                
                $fileNameToStore = 'noimage.jpg';
            }

            // dd('_-_-_');
        $newPersonalDetails = PersonalDetails::firstOrCreate([
            'student_id' => $studentId,
            'sex' => $request['sex'],
            'state_of_origin' => $request['state_of_origin'],
            'LGA_of_origin' => $request['LGA_of_origin'],
            'date_of_birth' => $request['date_of_birth'],
            'telephone' => $request['telephone'],
            'home_address' => $request['home_address'], 
            'photograph' => $fileNameToStore,
            ]);
        }

        if($user->student->kins->isEmpty()){
            $newNextOfKinDetails = NextOfKinDetails::firstOrCreate([
                'student_id' => $studentId,
                'name' => $request['name'],
                'address' => $request['address'],
                'relationship' => $request['relationship'],
                'phone' => $request['phone'],
                'email' => $request['email'],
            ]);
        }

        if($user->student->guardians->isEmpty()){
            $newGuardianDetails = GuardianDetails::firstOrCreate([
                'student_id' => $studentId,
                'guardian_name' => $request['guardian_name'],
                'guardian_address' => $request['guardian_address'],
                'guardian_telephone' => $request['guardian_telephone'],
                'guardian_email' => $request['guardian_email'],
            ]);
        }

        if($user->student->sponsors->isEmpty()){
            $newSponsorDetails = SponsorDetails::firstOrCreate([
                'student_id' => $studentId,
                'sponsor_name' => $request['sponsor_name'],
                'sponsor_address' => $request['sponsor_address'],
                'sponsor_telephone' => $request['sponsor_telephone'],
                'sponsor_email' => $request['sponsor_email'],
            ]);
        }
     

        // dd(auth()->user()->student);

        return redirect('/home')->with('success', 'Details registered successfully');
    }
}