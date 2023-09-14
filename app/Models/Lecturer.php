<?php

namespace App\Models;

use App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $guarded = [];




    public function course()
    {

        return $this->hasMany(Course::class);
    }


    public function department()
    {

        return $this->belongsTo(Department::class);

    }

}