<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Presenters\PostPresenter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = $this->user()
            ->posts()
            ->where('published', true)
            ->latest()
            ->paginate();

        return Inertia::render('Post/List', [
            'type' => 'published',
            'typeText' => '文章',
            'posts' => PostPresenter::collection($posts)
                ->preset('list')
                ->get(),
        ]);
    }

    public function drafts()
    {
        $posts = $this->user()
            ->posts()
            ->where('published', false)
            ->latest()
            ->paginate();

        return Inertia::render('Post/List', [
            'type' => 'drafts',
            'typeText' => '草稿',
            'posts' => PostPresenter::collection($posts)
                ->preset('list')
                ->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Post/Form', [
            'post' => PostPresenter::make(Post::make())->get(),
        ]);
    }

    public function store(PostRequest $request)
    {
        $post = $this->user()
            ->posts()
            ->create($request->validated());

        return redirect("/posts/{$post->id}")->with('success', '文章新增成功');
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
