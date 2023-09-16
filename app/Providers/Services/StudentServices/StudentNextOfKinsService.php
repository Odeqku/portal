<?php 

    namespace App\Providers\Services\StudentServices;
    use App\Models\NextOfKinDetails;

    class StudentNextOfKinsService
    {
        public function createNextOfKin($request)
        {
            return NextOfKinDetails::firstOrCreate([
                'student_id' => app('users_service')->studentUser()->id,
                'name' => $request['name'],
                'address' => $request['address'],
                'relationship' => $request['relationship'],
                'phone' => $request['phone'],
                'email' => $request['email'],
            ]);
        }
    }