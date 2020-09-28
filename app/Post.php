<?php

namespace App;

use App\Acquaintances\CanBeLiked;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Post extends Model
{
    use CanBeLiked;

    protected $perPage = 10;

    protected $fillable = [
        'title', 'description', 'content', 'thumbnail', 'visits', 'published',
    ];

    protected $casts = [
        'visits' => 'integer',
        'published' => 'boolean',
        'author_id' => 'integer',
    ];

    protected ?bool $isLikedCache = null;

    protected static function booted()
    {
        static::creating(function (self $post) {
            $post->updateDescription();
        });

        static::updating(function (self $post) {
            $post->updateDescription();
        });

        static::addGlobalScope('likers', fn (Builder $builder) => $builder->withCount('likers'));
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

    public function getIsLikedAttribute()
    {
        if (is_null($this->isLikedCache)) {
            $this->isLikedCache = Auth::user() ? $this->isLikedBy(Auth::user()) : false;
        }

        return $this->isLikedCache;
    }

    public function setThumbnailAttribute($thumbnail)
    {
        $this->attributes['thumbnail'] = $thumbnail instanceof UploadedFile
            ? $thumbnail->storeFile('posts')
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
