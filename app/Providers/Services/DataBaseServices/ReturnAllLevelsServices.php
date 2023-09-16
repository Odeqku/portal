<?php

namespace App\Providers\Services\DataBaseServices;
use App\Models\Level;

class ReturnAllLevelsServices
{
    public function allLevels()
    {
        return Level::all();
    }
}