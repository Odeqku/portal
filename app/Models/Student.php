<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{
    use HasFactory, HasRoles;

    protected $guarded = [];

    
    public function assignRole($role)
    {
        $roleId = Role::where('name', $role)->first()->id;
        
        $this->roles()->sync($roleId, false);
    }

    public function course(){
        return $this->belongsToMany(Course::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'profileable');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function course_student()
    {
        return $this->hasMany(Course_Student::class);
    }


    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function details()
    {
        return $this->hasMany(PersonalDetails::class);
    }

    public function kins()
    {
        return $this->hasMany(NextOfKinDetails::class);
    }

    public function guardians()
    {
        return $this->hasMany(GuardianDetails::class);
    }

    public function sponsors()
    {
        return $this->hasMany(SponsorDetails::class);
    }
}
