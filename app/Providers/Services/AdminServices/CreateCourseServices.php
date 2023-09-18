<?php 

    namespace App\Providers\Services\AdminServices;
    use App\Models\Course;
    use App\Models\CourseAccess;
    use App\Models\Department;
    use App\Models\Faculty;
    use App\Models\Lecturer;
    use App\Models\Level;
    use App\Models\Status;

    class CreateCourseServices
    {
        
        public function createCourse($request)
        {
            if(!(Course::where('name', $request['name'])->exists())){

                $newFaculty = Faculty::firstOrCreate([
                    'faculty_name' => $request['faculty_name'],
                ]);

                $newDepartment = Department::firstOrCreate([
                    'department_name' => $request['department_name'],
                    'faculty_id' =>$newFaculty->id,
                ]);

                $newlevel = Level::firstOrCreate([
                    'level_name' => $request['level_name']
                ]);

                $newStatus = Status::firstOrCreate([
                    'status_name' => $request['status_name']
                ]);

                $fileNameToStore = app('save_image_services')->saveUploadedImage($request);
                
                $newLecturer = Lecturer::create([
                    'lecturer_name' => $request['lecturer_name'],
                    'email' => $request['email'],
                    'telephone' => $request['telephone'],
                    'department_id' => $newDepartment->id,
                    'image' => $fileNameToStore,
                ]);

                $newCourse = Course::create([
                    'name' => $request['name'],
                    'point' => $request['point'],
                    'department_id' => $newDepartment->id,
                    'lecturer_id' => $newLecturer->id,
                    'level_id' => $newlevel->id,
                    'status_id' => $newStatus->id,
                    'semester' => $request['semester'],
                ]);
                
                $departments = app('departments_service')->allDepartments();
                return view('courses.departmentAccess', compact('newCourse', 'newDepartment', 'departments'));
        
            }else{
                
                return redirect()->back()->with('error', 'Course Already Exists');
            }
        }


        public function createCourseAccess($request)
        {
            
            foreach($request['course_access'] as $courseAcess){
            
                $newCourse_access = CourseAccess::create([
                    
                    'course_id' => json_decode($request['newCourse'])->id,
                    'department_id' => $courseAcess,
                    'level_id' => json_decode($request['newCourse'])->level_id,
                    'semester' => json_decode($request['newCourse'])->semester,
    
                ]);
                
            }

            return $newCourse_access;
        }

        
    }