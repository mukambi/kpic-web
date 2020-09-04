<?php

namespace App;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Lookup extends Model
{
    use UsesUuid;

    protected $fillable = [
        'patient_id', 'duplicate_patient_ids', 'first_name', 'last_name', 'yob', 'pcn_id', 'sep_id', 'month', 'year'
    ];

    protected $appends = [
        'duplicates'
    ];

    public function getDuplicatesAttribute()
    {
        $duplicate_ids = json_decode($this->duplicate_patient_ids) ?: [];
        return Patient::query()->whereIn('id', $duplicate_ids)->get();
    }

    public function patient()
    {
        return $this->belongsTo(
            Patient::class,
            'patient_id'
        );
    }
}
