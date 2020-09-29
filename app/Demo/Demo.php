<?php

namespace App\Demo;

use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;

class Demo
{
    protected static $errorMessage = 'Demo 環境無法登入/註冊用戶';

    /**
     * @param  bool  $can
     * @param  array|callable  $messages
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function block(bool $can, $messages)
    {
        if (App::environment('demo') && $can) {
            $messages = is_callable($messages) ? $messages(static::$errorMessage) : $messages;

            throw ValidationException::withMessages($messages);
        }
    }
}
