@extends('layouts.app')

@section('content')
<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">File</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                name="name" value="{{ old('name') }}" 
                required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <label for="photo" class="col-md-4 col-form-label">Photo</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
            @error('photo')
                <strong>{{ $message }}</strong>
            @enderror
        </div>

        <div class="row pt-4">
            <button class="btn btn-sm btn-primary">Upload Image</button>
        </div>
    </form>

    <div class="photo">
        @foreach (App\Models\Photo::all() as $photo)
            <div>
                <img src="/storage/{{ $photo->photo }}" class="w-100" alt="photo">
            </div>
        @endforeach
    </div>
</div>
@endsection
