<?php

namespace App;

use App\Http\Traits\UsesUuid;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

class SepUser extends Pivot
{
    use UsesUuid;

    /**
     * The the Migration Table name.
     *
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     * @var string
     */
    protected $table = 'sep_users';

    /**
     * The attributes that are mass assignable.
     *
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     * @var array
     */
    protected $fillable = ['user_id', 'sep_id'];

    /**
     * Create a new pivot model from raw values returned from a query.
     *
     * @param Model $parent
     * @param  $attributes
     * @param  $table
     * @param bool $exists
     *
     * @return Pivot
     * @throws Exception
     */
    public static function fromRawAttributes(Model $parent, $attributes, $table, $exists = false)
    {
        if (!$exists and !array_key_exists('id', $attributes)) {
            $attributes['id'] = (string)Str::uuid();
        }
        return parent::fromRawAttributes($parent, $attributes, $table, $exists);
    }

    /**
     * Get the user in the record
     *
     * @return BelongsTo
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    /**
     * Get the Service entry point in the record
     *
     * @return BelongsTo
     * @author Paul Gitau <kinyanjuipaul34@gmail.com>
     */
    public function sep()
    {
        return $this->belongsTo(
            Sep::class,
            'sep_id'
        );
    }
}
