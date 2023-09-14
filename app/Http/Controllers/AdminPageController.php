<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Course_Student;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{

    public function __construct()
    {
        
        $this->middleware(function ($request, $next){
            if (auth()->user()->profile->profileable_type === 'Admin') {
                return $next($request);
            }

            return redirect('/home'); 
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        // dd($user->profile->profileable_type);
        if($user->profile->profileable_type === "Student"){
            
            $student_user_id = $user->student->id;
            $Courses = Course::all();
            $studentCourses = Course_Student::all();
            $counter = 0;
            
            return view('admin_pages.admin_user_view', compact('user', 'student_user_id', 'Courses', 'studentCourses', 'counter'));
        }
            return redirect('/home');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return redirect('/home');
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
