<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Multicaret\Acquaintances\Traits\CanLike;

class User extends Authenticatable
{
    use Notifiable, CanLike;

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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    public function setAvatarAttribute($avatar)
    {
        $this->attributes['avatar'] = $avatar instanceof UploadedFile
            ? Storage::url($avatar->store('avatars'))
            : $avatar;
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function publishedPosts()
    {
        return $this->posts()->published();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likedPosts()
    {
        return $this->likes(Post::class)->published();
    }
}
