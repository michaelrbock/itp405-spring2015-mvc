@extends('layout')

@section('content')
    <h1>DVD Search</h1>

    <form action="/dvds" method="get">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title">
        </div>

        <div class="form-group">
            <label>Genre</label>
            <select class="form-control" name="genre_id">
                <option value="0">
                    All
                </option>
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
                <option value="0">
                    All
                </option>
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
