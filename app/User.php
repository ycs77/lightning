<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'description', 'avatar',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function (self $user) {
            if (! $user->avatar) {
                $user->avatar = $user->getAvatarUrl();
            }
        });
    }

    public function getAvatarUrl(string $default = 'mp', int $size = 80)
    {
        return sprintf(
            'https://www.gravatar.com/avatar/%s?d=%s&s=%s',
            md5(strtolower(trim($this->email))), urlencode($default), $size
        );
    }
}
