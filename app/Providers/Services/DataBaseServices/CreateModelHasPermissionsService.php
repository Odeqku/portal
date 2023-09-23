<?php 
    namespace App\Providers\Services\DataBaseServices;
    use App\Models\Admin;
    use App\Models\Student;
    use Spatie\Permission\Models\Role;



    class createModelHasPermissionsService
    {
        public function createModelHasPermissions(Student | Admin $model)
        {            
            $role = $model instanceOf Student ? Role::where('name', 'Student')
                    ->first() : Role::where('name', 'Admin')->first();
                                    
            foreach ($role->permissions as $key => $value) {                    
                $model->permissions()->attach($value->id);
            }                   
    
            return $model->permissions;
        }
    }
