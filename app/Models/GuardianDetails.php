<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardianDetails extends Model
{
    use HasFactory;

    public $guarded = [];

    public function students()
    {
        return $this->belongsTo(Student::class);
    }
}
