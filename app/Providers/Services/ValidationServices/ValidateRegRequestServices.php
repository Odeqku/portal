<?php 

    namespace App\Providers\Services\ValidationServices;

    class ValidateRegRequestServices
    {
        
        public $data1 = [
            'matric_number' => 'required',
            'semester' => 'required',
            'level' => 'required',
        ];

        public $data2 = [
            'sex' => 'required',
            'state_of_origin' => 'required',
            'LGA_of_origin' => 'required',
            'date_of_birth' => 'required',
            'telephone' => 'required',
            'home_address' => 'required',
            'photograph' => 'required',

            // Next of Kin's Details
            'name' => 'required',
            'address' => 'required',
            'relationship' => 'required',
            'phone' => 'required',
            'email' => 'required',

            // Guardian's Details
            'guardian_name' => 'required',
            'guardian_address' => 'required',
            'guardian_telephone' => 'required',
            'guardian_email' => 'required',

            //Sponsor's Details
            'sponsor_name' => 'required',
            'sponsor_address' => 'required',
            'sponsor_telephone' => 'required',
            'sponsor_email' => 'required'
        ];

        private $data3 = [

            'matric_number' => 'required',
            'semester' => 'required',
            'level' => 'required',

            'sex' => 'required',
            'state_of_origin' => 'required',
            'LGA_of_origin' => 'required',
            'date_of_birth' => 'required',
            'telephone' => 'required',
            'home_address' => 'required',
            'photograph' => 'required',

            // Next of Kin's Details
            'name' => 'required',
            'address' => 'required',
            'relationship' => 'required',
            'phone' => 'required',
            'email' => 'required',

            // Guardian's Details
            'guardian_name' => 'required',
            'guardian_address' => 'required',
            'guardian_telephone' => 'required',
            'guardian_email' => 'required',

            //Sponsor's Details
            'sponsor_name' => 'required',
            'sponsor_address' => 'required',
            'sponsor_telephone' => 'required',
            'sponsor_email' => 'required'
            
        ];

        

        public function validateRegRequest($request)
        {
            
            $studentUser = app('users_service')->studentUser();

            if($studentUser->details->isEmpty() && $request->has('level')){
                return $this->data3;
        
                }else{
                    return $this->data1;
                }
            }
    }