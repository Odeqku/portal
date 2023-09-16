<?php 

    namespace App\Providers\Services\DataBaseServices;
    use App\Models\Department;


    class ReturnAllDepartmentsServices

    {
        public function allDepartments()
        {
            return Department::all();
        }
    }