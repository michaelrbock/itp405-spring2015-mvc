@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-2">
            <ul class="nav">
                <li class="active"><a href="#">Search</a></li>
                <li>Genres</li>
                @foreach($genres as $genre)
                    <li><a href="{{ url('/genres/' . urlencode($genre->genre_name) . '/dvds') }}">{{ $genre->genre_name }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-10">
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
        </div>
    </div>
@stop
