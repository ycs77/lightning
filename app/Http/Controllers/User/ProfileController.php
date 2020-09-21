<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Presenters\PostPresenter;
use App\Presenters\UserPresenter;
use App\User;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $user->loadCount('publishedPosts');

        return Inertia::render('User/Profile', [
            'pageTitle' => "$user->name 的文章",
            'type' => 'show',
            'user' => UserPresenter::make($user)->with(fn (User $user) => [
                'posts' => PostPresenter::collection(
                    $user->posts()
                        ->with('author')
                        ->where('published', true)
                        ->latest()
                        ->paginate()
                )->preset('list'),
                'postsCount' => $user->published_posts_count,
            ])->get(),
        ]);
    }
}
