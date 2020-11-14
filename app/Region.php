<?php

namespace App;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use UsesUuid;

    protected $fillable = [
        'name'
    ];

    public function seps()
    {
        return $this->hasMany(
            Sep::class,
            'region_id'
        );
    }
}
