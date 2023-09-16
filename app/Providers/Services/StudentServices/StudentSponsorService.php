<?php 

    namespace App\Providers\Services\StudentServices;
    use App\Models\SponsorDetails;

    class StudentSponsorService
    {
        public function createStudentSponsor($request)
        {
            return SponsorDetails::firstOrCreate([
                'student_id' => app('users_service')->studentUser()->id,
                'sponsor_name' => $request['sponsor_name'],
                'sponsor_address' => $request['sponsor_address'],
                'sponsor_telephone' => $request['sponsor_telephone'],
                'sponsor_email' => $request['sponsor_email'],
            ]);
        }
    }