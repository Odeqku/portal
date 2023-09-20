<?php
namespace App\Providers\Services\StudentServices;
use App\Models\Profile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class CreateStudentUserService
{
    public function createStudentUser($data)
    {
        // dd('Service');
        // Generating matric number
        $student_matric_number = app('student_matric_number_service');
        $matricNumber = $student_matric_number->matricNumber($data);

        $new_user = app('new_user_service');
        $newUser = $new_user->createUser($data);
        

        $newStudent = $newUser->student()->create([
            'matric_number' => $matricNumber,
            'department_id' => (int)substr($matricNumber, 2, 2),
            'faculty_id' => (int)substr($matricNumber, 4, 2),
            'name' => $data['name'],
            'user_id' => $newUser->id,
            'level_id' => 30,
        ]);    

        $newProfile = Profile::create([
            'user_id' => $newUser->id,
            'profileable_id' => $newStudent->id,
            'profileable_type' => 'Student',
        ]);

        $newUser->assignRole('Student');
        $permissions = $this->createModelHasPermission($newStudent);     
        
            
        return redirect('/')->with('success', $data['profile']. ' registered successfully. You can login now');
    }


    public function createModelHasPermission($student)
    {
        $roles = Role::all();

        foreach($roles as $role){
            if($role->name === 'Student'){                
                foreach ($role->permissions as $key => $value) {                    
                    $student->permissions()->attach($value->id);
                }                
            }
        }

        return $student->permissions;
    }
    
}