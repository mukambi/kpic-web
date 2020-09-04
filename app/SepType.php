<?php

namespace App;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class SepType extends Model
{
    use UsesUuid;

    protected $fillable = [
        'name', 'code'
    ];

    public function sep()
    {
        return $this->hasMany(
            Sep::class,
            'type_id'
        );
    }
}
