<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseAccess;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Lecturer;
use App\Models\Level;
use App\Models\Status;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return app('courses_and_departments_service')->coursesAndDepartments();        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {      
        
        return app('faculties_and_semesters_service')->facultiesAndSemesters();   
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $profileType = auth()->user()->profile->profileable_type;
        if(!($profileType === 'Student') && !(Course::where('name', $request['name'])->exists())){
        
            
            $this->validate($request, [
                'name' => 'required',
                'point' => 'required',
                'lecturer_name' => 'required',
                'email' => 'required',
                'telephone' => 'required',
                'level_name' => 'required',
                'status_name' => 'required',
                'department_name' => 'required',
                'faculty_name' => 'required',
                'image' => 'image|nullable|max:1999',
                'semester' => 'required',
            ]);
        
            

        

        $newFaculty = Faculty::firstOrCreate([
            'faculty_name' => $request['faculty_name'],
        ]);

        $newDepartment = Department::firstOrCreate([
            'department_name' => $request['department_name'],
            'faculty_id' =>$newFaculty->id,
        ]);

        $newlevel = Level::firstOrCreate([
            'level_name' => $request['level_name']
        ]);

        $newStatus = Status::firstOrCreate([
            'status_name' => $request['status_name']
        ]);


        if($request->hasFile("image")){
            //get filename with the extention 
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
        
            //filename to store
            $fileNameToStore = $filename . '_'. time(). '.' . $extension;
        
            //
            $path = $request->file('image')->storeAs('public/images',$fileNameToStore);
        }else{
            
            $fileNameToStore = 'noimage.jpg';
        }

        $newLecturer = Lecturer::create([
            'lecturer_name' => $request['lecturer_name'],
            'email' => $request['email'],
            'telephone' => $request['telephone'],
            'department_id' => $newDepartment->id,
            'image' => $fileNameToStore,
        ]);

        $newCourse = Course::create([
            'name' => $request['name'],
            'point' => $request['point'],
            'department_id' => $newDepartment->id,
            'lecturer_id' => $newLecturer->id,
            'level_id' => $newlevel->id,
            'status_id' => $newStatus->id,
            'semester' => $request['semester'],
        ]);

        
        // return redirect('/')
        // ->with('success', 'Course Created');
        $departments = Department::all();
        // dd('hi');
        return view('courses.departmentAccess', compact('newCourse', 'newDepartment', 'departments'));
        
    }else{
        return redirect()->back()->with('error', 'Course Already Exists');
    }
}


    public function storeCourseAccess(Request $request)
    {
        // dd(json_decode($request['newCourse'])->semester);
        // dd($request['course_access']);
        // dd(json_decode($request['newCourse'])->level_id);

        foreach($request['course_access'] as $courseAcess){
            $newCourse_access = CourseAccess::create([
                
                'course_id' => json_decode($request['newCourse'])->id,
                'department_id' => $courseAcess,
                'level_id' => json_decode($request['newCourse'])->level_id,
                'semester' => json_decode($request['newCourse'])->semester,

            ]);
            
        }
        return redirect('/')
        ->with('success', 'Course Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $courses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $courses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $courses)
    {
        //
    }
}