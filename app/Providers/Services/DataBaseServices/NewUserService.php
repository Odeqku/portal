<?php
namespace App\Providers\Services\DataBaseServices;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class NewUserService
{
    public function createUser($data)
    {
        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $newUser;
    }
}