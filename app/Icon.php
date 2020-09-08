<?php

namespace App;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    use UsesUuid;

    protected $fillable = [
        'name', 'image_url', 'code'
    ];

    protected $appends = [
        'asset_url'
    ];

    public function getAssetUrlAttribute()
    {
        return asset($this->image_url);
    }

    public function patients()
    {
        return $this->hasMany(
            Patient::class,
            'icon_id'
        );
    }
}
