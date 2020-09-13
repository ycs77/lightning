<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($this->user()->id),
            ],
            'description' => 'nullable|string|max:100',
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|max:5120',
        ];
    }

    public function validationData()
    {
        $data = parent::validationData();

        if (! $data['password']) {
            unset($data['password']);
        }

        if (! $data['avatar']) {
            unset($data['avatar']);
        }

        return $data;
    }
}
