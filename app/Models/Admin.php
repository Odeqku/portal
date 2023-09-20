<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Model
{
    use HasFactory, HasRoles;

    protected $guarded = [];

    public function assignRole($role)
    {
        $roleId = Role::where('name', $role)->first()->id;
        $this->roles()->sync($roleId, false);
    }

    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'profileable');
    }
}
