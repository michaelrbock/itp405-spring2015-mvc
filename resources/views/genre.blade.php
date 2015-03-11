@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-2"><h1>{{ $genre->genre_name }} Results</h1></div>
        <div class="col-md-1">
            <a class="btn btn-default" href="/dvds/search" role="button">Back to Search</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title (Click for detail page)</th>
                <th>Rating</th>
                <th>Genre</th>
                <th>Label</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dvds as $dvd)
            <tr>
                <td><a href="/dvds/{{ $dvd->id }}">{{ $dvd->title }}</a></td>
                <td>
                    @if ($dvd->rating)
                        {{ $dvd->rating->rating_name }}
                    @endif
                </td>
                <td>{{ $dvd->genre->genre_name }}</td>
                <td>
                    @if ($dvd->label)
                        {{ $dvd->label->label_name }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
