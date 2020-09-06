<?php

namespace App;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

class IconPatient extends Pivot
{
    use UsesUuid;

    protected $table = 'icon_patients';

    protected $fillable = [
        'icon_id', 'patient_id'
    ];

    public static function fromRawAttributes(Model $parent, $attributes, $table, $exists = false)
    {
        if (!$exists and !array_key_exists('id', $attributes)) {
            $attributes['id'] = (string) Str::uuid();
        }
        return parent::fromRawAttributes($parent, $attributes, $table, $exists);
    }
}
