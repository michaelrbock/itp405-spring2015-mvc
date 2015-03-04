@extends('layout')

@section('content')
    <h1>Add a DVD</h1>

    <div class="row">
        @foreach($errors->all() as $errorMessage)
            <div class="alert alert-danger" role="alert">
                {{ $errorMessage }}
            </div>
        @endforeach

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>

    <form action="/dvds" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title">
        </div>

        <div class="form-group">
            <label>Release Date</label>
            <input type="date" name="release_date">
        </div>

        <div class="form-group">
            <label>Label</label>
            <select class="form-control" name="label_id">
                @foreach($labels as $label)
                    <option value="{{ $label->id }}">
                        {{ $label->label_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Sound</label>
            <select class="form-control" name="sound_id">
                @foreach($sounds as $sound)
                    <option value="{{ $sound->id }}">
                        {{ $sound->sound_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Genre</label>
            <select class="form-control" name="genre_id">
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">
                        {{ $genre->genre_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Rating</label>
            <select class="form-control" name="rating_id">
                @foreach($ratings as $rating)
                    <option value="{{ $rating->id }}">
                        {{ $rating->rating_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-default">Submit</button>
    </form>

@stop