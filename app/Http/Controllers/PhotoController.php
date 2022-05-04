<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use App\Models\Photo;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(Photo $photo)
    {

        $data = request()->validate([
            'name' => 'required',
            'photo' => 'required | image',
        ]);

        $phPath = request('photo')->store('uploads', 'public');
        $ph = Image::make(public_path("storage/{$phPath}"))->fit(1200, 1200);
        $ph->save();

        $photo->name = $data['name'];
        $photo->photo = $phPath;
        $photo->save();

        return view("home");
    }
}
