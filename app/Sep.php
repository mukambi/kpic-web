<?php

namespace App;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Sep extends Model
{
    use UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'type_id'
    ];

    public function users()
    {
        return $this->hasMany(
            User::class,
            'sep_id'
        );
    }

    public function type()
    {
        return $this->belongsTo(
            SepType::class,
            'type_id'
        );
    }
}
