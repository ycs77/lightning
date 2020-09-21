<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// User
Route::get('user/setting', 'User\UserController@edit');
Route::put('user', 'User\UserController@update');
Route::delete('user', 'User\UserController@destroy');
Route::get('user/{user}', 'User\ProfileController@index');

// Posts
Route::get('/', 'Post\ShowPostList');
Route::resource('posts', 'Post\PostController')->except('show');
Route::get('posts/drafts', 'Post\PostController@drafts');
Route::get('posts/{post}', 'Post\ShowPost');

// Auth
Auth::routes(['reset' => false]);

// Upload files
Route::post('upload/mavon-editor-image', 'UploadController@mavonEditorImage');
