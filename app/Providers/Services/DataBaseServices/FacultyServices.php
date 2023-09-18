<?php 

    namespace App\Providers\Services\DataBaseServices;
    use App\Models\Faculty;   


    class FacultiesServices

    {
        // departments_service
        public function allFaculties()
        {
            return Faculty::all();
        }
    }