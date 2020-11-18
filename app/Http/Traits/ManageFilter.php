<?php

namespace App\Http\Traits;

use App\Region;

trait ManageFilter
{
    public function getAllRegions()
    {
        return Region::all();
    }
}
