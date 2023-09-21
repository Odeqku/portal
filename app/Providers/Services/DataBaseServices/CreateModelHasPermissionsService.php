<?php 
    namespace App\Providers\Services\DataBaseServices;
    use Spatie\Permission\Models\Role;



    class createModelHasPermissionsService
    {
        public function createModelHasPermissions($model)
        {            
            $rol_e = $model instanceOf Student ? 'Student' : 'Admin';
    
            foreach(Role::all() as $role){
                
                    if($role->name === $rol_e){                
                        foreach ($role->permissions as $key => $value) {                    
                            $model->permissions()->attach($value->id);
                        }
                        break; // I am working on the assumption that no two or more roles can be mutually inclusive               
                    }             
            }
    
            return $model->permissions;
        }
    }
