<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'photo' => 'required | image',
        ]);

        $photoPath = request('photo')->store('uploads', 'public');

        $photo = Image::make(public_path("storage/{$photoPath}"))->fit(1200, 1200);
        $photo->save();

        return view("home");
    }
}
