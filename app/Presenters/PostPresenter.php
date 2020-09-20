<?php

namespace App\Presenters;

use AdditionApps\FlexiblePresenter\FlexiblePresenter;
use App\Post;

class PostPresenter extends FlexiblePresenter
{
    public function values(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'visits' => $this->visits,
            'created_at' => optional($this->created_at)->format('Y-m-d H:i:s'),
            'created_ago' => optional($this->created_at)->diffForHumans(),
            'published' => $this->published,
        ];
    }

    public function presetList()
    {
        return $this->with(fn (Post $post) => [
            'author' => fn () => UserPresenter::make($post->author)
                ->only('id', 'name', 'avatar')
                ->get(),
        ]);
    }

    public function presetShow()
    {
        return $this->with(fn (Post $post) => [
            'content' => $post->content,
            'author' => fn () => UserPresenter::make($post->author)
                ->preset('withCount')
                ->get(),
        ]);
    }
}
