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
        'location', 'name', 'code', 'type_id', 'geocode'
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'sep_users',
            'sep_id',
            'user_id'
        )->using(SepUser::class)
            ->withTimestamps();
    }

    public function type()
    {
        return $this->belongsTo(
            SepType::class,
            'type_id'
        );
    }
}
