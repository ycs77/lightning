<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'HelloWorld', [
    'name' => 'Lucas',
]);
Route::inertia('about', 'About');

// User
Route::get('user/setting', 'User\UserController@edit');
Route::put('user', 'User\UserController@update');

// Auth
Auth::routes(['reset' => false]);
