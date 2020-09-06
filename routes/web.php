<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'HelloWorld', [
    'name' => 'Lucas',
]);
Route::inertia('about', 'About');
