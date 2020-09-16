<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title', 'description', 'content', 'thumbnail', 'visits', 'published',
    ];

    protected $casts = [
        'visits' => 'integer',
        'published' => 'boolean',
        'author_id' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function (self $post) {
            $post->updateDescription();
        });

        static::updating(function (self $post) {
            $post->updateDescription();
        });
    }

    public function updateDescription()
    {
        $this->description = Str::limit(preg_replace('/\r|\n/', '', $this->content), 80);

        return $this;
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
