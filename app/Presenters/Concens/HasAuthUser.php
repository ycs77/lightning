<?php

namespace App\Presenters\Concens;

use App\User;
use Illuminate\Support\Facades\Auth;

trait HasAuthUser
{
    protected function user(): ?User
    {
        return Auth::user();
    }

    protected function userCan($abilities, $arguments = []): bool
    {
        return (bool) optional($this->user())->can($abilities, $arguments);
    }
}
