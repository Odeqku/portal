<?php
namespace App\Providers\Services\AdminServices;
use App\Models\Admin;
use App\Models\AdminToken;
use App\Models\Profile;
use App\Providers\Services\DataBaseServices\createModelHasPermissionsService as ModelHasP;
use Spatie\Permission\Models\Role;


class CreateAdminUserService extends ModelHasP
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

        $permissions = $this->createModelHasPermissions($admin);        

        return redirect('/')
        ->with('success', $data['profile']. ' registered successfully. You can loging now');
    
    }    
}