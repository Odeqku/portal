<?php 

    namespace App\Providers\Services\StudentServices;
    use App\Models\PersonalDetails;


    class StudentPersonalDetailsService
    {
        public function createStudentDetails($request, $fileNameToStore)
        {
            
            return PersonalDetails::firstOrCreate([
                'student_id' => app('users_service')->studentUser()->id,
                'sex' => $request['sex'],
                'state_of_origin' => $request['state_of_origin'],
                'LGA_of_origin' => $request['LGA_of_origin'],
                'date_of_birth' => $request['date_of_birth'],
                'telephone' => $request['telephone'],
                'home_address' => $request['home_address'], 
                'photograph' => $fileNameToStore,
            ]);

        }
    }