<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $perPage = 10;

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
        $this->description = $this->generateDescription($this->content, 80);

        return $this;
    }

    public function generateDescription(string $markdown, int $limit): string
    {
        $text = strip_tags(app('parsedown')->parse($markdown));
        $text = preg_replace("/\r|\n/", '', $text);

        return Str::limit($text, $limit);
    }

    public function setThumbnailAttribute($thumbnail)
    {
        $this->attributes['thumbnail'] = $thumbnail instanceof UploadedFile
            ? Storage::url($thumbnail->store('posts'))
            : $thumbnail;
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published', false);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
