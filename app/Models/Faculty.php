<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    // protected $fillable = ['faculty_name', /* other fillable attributes */];

    protected $guarded = [];



    public static $faculties = ['Science', 'Engineering', 'Art', 'Management', 'Education', 'Social Sciences', 'Medicine'];


    public function student()
    {
        return $this->hasMany(Student::class);
    }


    public function department()
    {
        return $this->hasMany(Department::class);
        
    }
}
