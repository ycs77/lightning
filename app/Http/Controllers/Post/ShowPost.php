<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Post;
use App\Presenters\PostPresenter;
use Inertia\Inertia;

class ShowPost extends Controller
{
    public function __invoke(Post $post)
    {
        $this->authorize('view', $post);

        $this->incrementVisit($post);

        $post->load(['author' => fn ($query) => $query->withCount('publishedPosts', 'likedPosts')]);

        return Inertia::render('Post/Show', [
            'post' => PostPresenter::make($post)
                ->preset('show')
                ->get(),
            'postOnlyLikes' => PostPresenter::make($post)
                ->only('likes')
                ->with(fn (Post $post) => [
                    'is_liked' => $post->isLiked,
                ])
                ->get(),
        ]);
    }

    protected function incrementVisit(Post $post)
    {
        if (! optional($this->user())->can('view', $post) &&
            ! session("posts:visits:{$post->id}")
        ) {
            $post->increment('visits');
            session()->put("posts:visits:{$post->id}", true);
        }
    }
}
