<?php
namespace App\Providers\Services\AdminServices;
use App\Models\Admin;
use App\Models\AdminToken;
use App\Models\Profile;
use Spatie\Permission\Models\Role;


class CreateAdminUserService
{
    public function createAdminUser($data)
    {        
        $tokenExists = AdminToken::where('admin_token', $data['token'])->exists();
        
        if (!$tokenExists) {
            return redirect('/registration')
            ->withErrors(['error' => 'Provide a valid token or register as a student']);
        }

        $new_user = app('new_user_service');
        $newUser = $new_user->createUser($data);        
        
        $admin = $newUser->admin()->create([
            'user_id' => $newUser->id,
        ]);

        $adminProfile = Profile::create([
            'user_id' => $newUser->id,
            'profileable_id' => $admin->id,
            'profileable_type' => 'Admin',
        ]);

        $newUser->assignRole('Admin');

        $permissions = $this->createModelHasPermission($admin);        

        return redirect('/')
        ->with('success', $data['profile']. ' registered successfully. You can loging now');
    
    }

    public function createModelHasPermission($admin) : null
    {
        $roles = Role::all();

        foreach($roles as $role){
            if($role->name === 'Admin'){                
                foreach ($role->permissions as $key => $value) {                    
                    $admin->permissions()->attach($value->id);
                }                
            }
        }

        return $admin->permissions;
    }
}