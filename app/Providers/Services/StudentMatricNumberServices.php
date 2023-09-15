<?php
namespace App\Providers\Services;
use App\Models\Student;


class StudentMatricNumberServices
{
    public function matricNumber($studentData) {

        $refinedData = json_decode($studentData['department']);

        $faculty_id = $refinedData->faculty_id;        
        $department_id = $refinedData->id;

        $count = Student::where('department_id', $department_id)->count();
        
        if(strlen((string)$count) < 2){            
            $count += 1;
            $count = '0' . $count;
        }else{
            $count += 1;
        }

        if(strlen((string)$department_id) < 2){
            $department_id = '0' . $department_id;
        }

        if(strlen((string)$faculty_id) < 2) {
            $faculty_id = '0' . $faculty_id;
        }        
        return substr(date('Ymd'), 2, 2) . $department_id . $faculty_id . $count;
    }
}