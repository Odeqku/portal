<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Course_Student;
use Illuminate\Http\Request;

class RegisteredCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(session('studentDetailsRequest'));
        // dd($request['studentDetails']);
        $registeredCourses = $request['registered-courses'];

        try{

            foreach($registeredCourses as $course){
                $newCourse_Student = Course_Student::create([
                    
                    'course_id' => Course::where('name', $course)->first()->id,
                    'student_id' => auth()->user()->student->id,

                ]);
                
            }

            return view('pages.studentDashboard');
        }catch(\Exception $e){
            return redirect('/home')->with('error', 'Choose atleast a course');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}