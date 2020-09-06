<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'kpic_code', 'short_kpic_code', 'hash', 'first_name', 'last_name', 'yob', 'mob', 'sep_id', 'icon_id'
    ];

    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

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
