<?php 

    namespace App\Providers\Services\DataBaseServices;
    use App\Models\Faculty;   


    class FacultyServices

    {
        // departments_service
        public function allFaculties()
        {
            return Faculty::all();
        }
    }