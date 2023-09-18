<?php 

    namespace App\Providers\Services\DataBaseServices;
    use App\Models\Department;


    class ReturnAllDepartmentsServices

    {
        // departments_service
        public function allDepartments()
        {
            return Department::all();
        }
    }