<?php

namespace Dev\Visitor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * Class Visitor
 *
 * @package Dev\Visitor\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $visitorable_id
 * @property string $visitorable_type
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $visitorable
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $user
 */
class Visitor extends Model
{
    protected $fillable = [
        'user_id',
        'visitorable_id',
        'visitorable_type',
    ];

    /**
     * Define the polymorphic, visitorable relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function visitorable()
    {
        return $this->morphTo();
    }

    /**
     * Define the user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        $userClassName = Config::get('auth.model');
        if (is_null($userClassName)) {
            $userClassName = Config::get('auth.providers.users.model');
        }

        return $this->belongsTo($userClassName);
    }
}
