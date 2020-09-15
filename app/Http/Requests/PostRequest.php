<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:80',
            'content' => 'required',
            'thumbnail' => 'nullable|image|max:5120',
            'published' => 'boolean',
        ];
    }

    public function validationData()
    {
        $data = parent::validationData();

        $data['published'] = $data['published'] === 'true';

        if (! $data['thumbnail']) {
            unset($data['thumbnail']);
        }

        return $data;
    }
}
