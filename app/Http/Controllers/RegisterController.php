<?php

namespace App\Http\Controllers;
use App\Providers\Services\DataBaseServices\FacultyServices;
use App\Providers\Services\DataBaseServices\ReturnAllDepartmentsServices;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
        public function index(ReturnAllDepartmentsServices $dept, FacultyServices $fclt)
    {
        // dd();
        // $count = 0;
        // $users = User::all();
        // foreach($users as $user){
        //     if((Admin::where('user_id', $user->id)->exists())){
        //         $user->assignRole('Admin');
        //         $count += 1;
        //         echo $user->name. ';' . ' No, has no role yet'. ' ' . ': '; 
        //         echo $user->id . '<br />';
        //     }
        // }
        // Student::find(1)->assignRole('Student');
        // dd('Done');
        // dd(User::find(39)->assignRole('Student')->hasRole('Student'));
        $departments = $dept->allDepartments();
        $faculties = $fclt->allFaculties();
        
        $profiles = Role::all()->reject(function ($role) {
            return $role->name === 'super admin';
        });
        
        
        return view('auth.register', compact('departments', 'faculties', 'profiles'));
    }
}