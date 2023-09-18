<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Providers\Services\AdminServices\CreateCourseServices as CCS;
use App\Providers\Services\DataBaseServices\ReturnAllCoursesAndDepartmentsServices as CrsDept;
use App\Providers\Services\DataBaseServices\ReturnAllFacultiesAndSemestersServices as fcltSem;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest as RegR;

class CoursesController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CrsDept $Cd)
    {        
        return $Cd->coursesAndDepartments();        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(fcltSem $u)
    {      
        
        return $u->facultiesAndSemesters(); 
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegR $request, CCS $c)
    {
        return $c->createCourse($request);
    }


    public function storeCourseAccess(Request $request, CCS $c)
    {
        
        $newCourse_access = $c->createCourseAccess($request);
        
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