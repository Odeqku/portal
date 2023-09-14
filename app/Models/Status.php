<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    const PENDING = 1;
    const ACTIVE = 2;
    protected $guarded = [];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
