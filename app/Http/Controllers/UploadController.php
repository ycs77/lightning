<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mavonEditorImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        return $request->file('image')->storeFile('images');
    }
}
