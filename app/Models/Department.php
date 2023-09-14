<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function lecturer()
    {

        return $this->hasMany(lecturer::class);
    }

    // protected $table = 'course_accesses';
    public function course()
    {

        return $this->belongsToMany(Course::class)->using(CourseAccess::class);
    }

    public function courses()
    {

        return $this->belongsTo(Course::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }


    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function course_accesses()
    {
        return $this->hasMany(CourseAccess::class);
    }
}