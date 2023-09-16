<?php 

    namespace App\Providers\Services\DataBaseServices;
    use App\Models\Course;


    class ReturnAllCoursesService
    {
        public function allCourses()
        {
            return Course::all();
        }
    }