<?php 

    namespace App\Providers\Services\StudentServices;
    use App\Models\GuardianDetails;

    class StudentGuardianDetailsService
    {
        public function createStudentGuardian($request)
        {
            
            return GuardianDetails::firstOrCreate([
                'student_id' => app('users_service')->studentUser()->id,
                'guardian_name' => $request['guardian_name'],
                'guardian_address' => $request['guardian_address'],
                'guardian_telephone' => $request['guardian_telephone'],
                'guardian_email' => $request['guardian_email'],
            ]);
        }
    }