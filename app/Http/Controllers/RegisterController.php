<?php

namespace App\Http\Controllers;
use App\Providers\Services\DataBaseServices\FacultiesServices;
use App\Providers\Services\DataBaseServices\ReturnAllDepartmentsServices;
use App\Providers\Services\DataBaseServices\ReturnUserProfileServices;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
        public function index(ReturnAllDepartmentsServices $dept, FacultiesServices $fclt, ReturnUserProfileServices $userProf)
    {
        $departments = $dept->allDepartments();
        $faculties = $fclt->allFaculties();
        $profiles = $userProf->userProfile();
        
        return view('auth.register', compact('departments', 'faculties', 'profiles'));
    }
}