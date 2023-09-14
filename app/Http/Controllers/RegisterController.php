<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        // dd('Fooo');
        $departments = Department::all();
        $faculties = Faculty::all();
        $profiles = ['Student', 'Admin'];
        // dd($departments);
        return view('auth.register', compact('departments', 'faculties', 'profiles'));
    }
}