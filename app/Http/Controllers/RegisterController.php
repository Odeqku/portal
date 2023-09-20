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
        // $permission = \Spatie\Permission\Models\Permission::findByName('edit profile');
        // dd($permission);
        // $stds = \App\Models\Admin::all();
        // $roles = Role::all();
        // dd($roles);
        // foreach($stds as $std){
            // foreach($roles as $role){
            //     if($role->name === 'Admin'){
            //         // echo $role->name . ' :' . '<br />';
            //         // echo $std->id . ' :' . '<br />';
            //         // echo $std->name . ' :' . '<br />';
            //         foreach ($role->permissions as $key => $value) {
            //             // echo $key . ':' . $value->id . ' ';
            //             // echo $value['name'] . '<br />';
            //             // echo $std . '<br />';
            //             // echo $value['name'];
            //             // $std->permissions()->attach($value->id);
            //         }
            //         // echo '<br />';
            //     }
            // }
            // echo $std->permissions;
        // }
            
        //    echo $role->permissions . '<br />';
        
        // dd('done');
        // $user = \App\Models\User::find(7);
        // dd($user->permissions());
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