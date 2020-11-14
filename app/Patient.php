<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'kpic_code', 'sep_id', 'icon_id', 'possible_duplicate'
    ];

    protected $casts = [
        'possible_duplicate' => 'boolean',
    ];

    public function pcn()
    {
        return $this->belongsTo(
            Pcn::class,
            'pcn_id'
        );
    }

    public function sep()
    {
        return $this->belongsTo(
            Sep::class,
            'sep_id'
        );
    }

    public function lookups()
    {
        return $this->hasMany(
            Lookup::class,
            'patient_id'
        );
    }

    public function icon()
    {
        return $this->belongsTo(
            Icon::class,
            'icon_id'
        );
    }
}
