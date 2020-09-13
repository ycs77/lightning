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
Route::delete('user', 'User\UserController@destroy');
Route::get('user/{user}', 'User\ProfileController@index');

// Auth
Auth::routes(['reset' => false]);
