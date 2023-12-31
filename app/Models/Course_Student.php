<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_Student extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
