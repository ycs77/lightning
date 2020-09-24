<?php

namespace App\Presenters;

use AdditionApps\FlexiblePresenter\FlexiblePresenter;
use App\User;

class UserPresenter extends FlexiblePresenter
{
    public function values(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'avatar' => $this->avatar,
        ];
    }

    public function presetWithCount()
    {
        return $this->with(fn (User $user) => [
            'postsCount' => $user->publishedPosts()->count(),
            'likesCount' => $user->likedPosts()->count(),
        ]);
    }
}
