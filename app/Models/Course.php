<?php

namespace App\Models;

use App\Models\Lecturer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // public $newCourse = $this->id;

    protected $guarded = [];

    public function lecturer()
    {

        return $this->belongsTo(lecturer::class);
    }

    // protected $table = 'course_accesses';
    public function department()
    {
        
        return $this->belongsTo(Department::class);

    }

    public function departments()
    {
        
        return $this->belongsToMany(Department::class)->using(CourseAccess::class);

    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }


    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function student()
    {
        return $this->belongsToMany(Student::class);

    }


    public function course_student()
    {
        return $this->hasMany(Course_Student::class);
    }

    public function course_accesses()
    {
        return $this->hasMany(CourseAccess::class);
    }
}
