<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'kpic_code', 'sep_id', 'icon_id', 'possible_duplicate', 'creator_id'
    ];

    protected $casts = [
        'possible_duplicate' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'creator_id'
        );
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

    public function icon()
    {
        return $this->belongsTo(
            Icon::class,
            'icon_id'
        );
    }

    public function trails()
    {
        return $this->hasMany(
            AuditTrail::class,
            'patient_id'
        );
    }
}
