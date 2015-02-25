@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-2"><h1>Results</h1></div>
        <div class="col-md-1">
            <a class="btn btn-default" href="/dvds/search" role="button">Back to Search</a>
        </div>
    </div>

    @if ($title)
        <div class="alert alert-info" role="alert">
            You searched for movies with the title '{{ $title }}'.
        </div>
    @endif

    @if ($genre_id && $genre_id != '0' && is_numeric($genre_id))
        <div class="alert alert-info" role="alert">
            @foreach($genres as $genre)
                @if ($genre->id == $genre_id)
                    You searched for movies in the {{ $genre->genre_name }} genre.
                @endif
            @endforeach
        </div>
    @endif

    @if ($rating_id && $rating_id != '0' && is_numeric($rating_id))
        <div class="alert alert-info" role="alert">
            @foreach($ratings as $rating)
                @if ($rating->id == $rating_id)
                    You searched for movies with a {{ $rating->rating_name }} rating.
                @endif
            @endforeach
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title (Click for detail page)</th>
                <th>Rating</th>
                <th>Genre</th>
                <th>Label</th>
                <th>Sound</th>
                <th>Format</th>
                <th>Release Date</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dvds as $dvd)
            <tr>
                <td><a href="/dvds/{{ $dvd->id }}">{{ $dvd->title }}</a></td>
                <td>{{ $dvd->rating_name }}</td>
                <td>{{ $dvd->genre_name }}</td>
                <td>{{ $dvd->label_name }}</td>
                <td>{{ $dvd->sound_name }}</td>
                <td>{{ $dvd->format_name }}</td>
                <td>{{ $dvd->formatted_date }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
