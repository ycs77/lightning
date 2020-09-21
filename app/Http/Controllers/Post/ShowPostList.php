<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Post;
use App\Presenters\PostPresenter;
use Inertia\Inertia;

class ShowPostList extends Controller
{
    public function __invoke()
    {
        $posts = Post::with('author')
            ->where('published', true)
            ->latest()
            ->paginate();

        return Inertia::render('Home', [
            'posts' => PostPresenter::collection($posts)
                ->preset('list')
                ->get(),
        ]);
    }
}
