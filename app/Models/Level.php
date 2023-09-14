<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function user()
    {

        return $this->hasMany(User::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }
}