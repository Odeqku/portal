<?php

namespace Database\Seeders;



use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create an admin user
        // $admin = User::create([
        //     'name' => 'Admin User',
        //     'email' => 'name@emailDomain.com',
        //     'password' => bcrypt('password'),
        // ]);

        // $admin->assignRole('admin');


        // $student = User::create([
        //     'name' => 'Student User',
        //     'email' => 'student@example.com',
        //     'password' => bcrypt('password'),
        // ]);
        // $student->assignRole('student');

    }
}
