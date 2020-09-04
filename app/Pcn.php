<?php

namespace App;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Pcn extends Model
{
    use UsesUuid;

    protected $fillable = [
        'name', 'number'
    ];
}
