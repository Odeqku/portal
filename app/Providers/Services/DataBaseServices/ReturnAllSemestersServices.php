<?php

namespace App\Providers\Services\DataBaseServices;
use App\Models\User;

class ReturnAllSemestersServices
{
    public function allSemesters()
    {
        return ['first semester', 'second semester'];
    }
}