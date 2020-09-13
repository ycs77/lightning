<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Presenters\UserPresenter;
use App\User;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        return Inertia::render('User/Profile', [
            'user' => UserPresenter::make($user)->get(),
        ]);
    }
}
