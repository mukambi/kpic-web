<?php

namespace App;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use UsesUuid;

    protected $fillable = [
        'sep_id', 'patient_id', 'user_id', 'action'
    ];

    public function patient()
    {
        return $this->belongsTo(
            Patient::class,
            'patient_id'
        );
    }

    public function sep()
    {
        return $this->belongsTo(
            Sep::class,
            'sep_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}
