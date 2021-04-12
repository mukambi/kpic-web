<?php

namespace App;

use App\Http\Traits\HasAvatar;
use App\Http\Traits\UsesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasAvatar, Notifiable, UsesUuid, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'sep_id', 'activated_at', 'password_activated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isActivated()
    {
        return !empty($this->activated_at);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sep()
    {
        return $this->belongsTo(
            Sep::class,
            'sep_id'
        );
    }

    public function patients()
    {
        return $this->hasMany(
            Patient::class,
            'creator_id'
        );
    }

    public function isActivePassword()
    {
        return !empty($this->password_activated_at);
    }

    public function canEdit()
    {
        foreach ($this->roles as $role) {
            if (in_array($role->name, $this->supportedRoles())){
                return true;
            }
        }
        return false;
    }

    public function supportedRoles(): array
    {
        $supported_roles = [];
        foreach (auth()->user()->roles->pluck('name') as $user_role) {
            $supported_roles = array_merge($supported_roles, [
                'super admin' => [
                    'super admin',
                    'admin',
                    'manager',
                    'user'
                ],
                'admin' => [
                    'admin',
                    'manager',
                    'user'
                ],
                'manager' => [
                    'manager',
                    'user'
                ],
                'user' => [
                    'user'
                ]
            ][$user_role]);
        }
        return $supported_roles;
    }
}
