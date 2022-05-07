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
        $ph = Image::make(public_path("storage/{$phPath}"))->fit(200, 200)->pixelate(10);
        $ph->save();
        dd($this->doSomething($ph));

        $photo->name = $data['name'];
        $photo->photo = $phPath;
        $photo->save();

        return view("home");
    }

    private function doSomething($ph, $anArray = []) {
        for ($x = 0; $x < $ph->width(); $x++) {
            for ($y = 0; $y < $ph->height(); $y++) {
                $color = $ph->pickColor($x, $y);
                $anArray[] = [$x, $y, $color];
            }
        }
        return $anArray;
    }
}
