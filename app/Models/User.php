<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Airlock\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'email_verified_at',
        'phone',
        'phone_verified_at',
        'password',
        'avatar',
        'realname',
        'last_active_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public static function cachedFind($id, $columns = ['*'])
    {
        $tag = 'model_user_' . $id;
        $ttl = 3600;
        return Cache::tags($tag)->remember($tag, $ttl, function() use ($id, $columns) {
            return static::find($id, $columns);
        });
    }
}
