@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-1">
            <a class="btn btn-default" href="/dvds/search" role="button">Back to Search</a>
        </div>
    </div>
    <div class="row">
        <h1>Details Page for {{ $dvd->title }}</h1>
    </div>

    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Rating</th>
                    <th>Genre</th>
                    <th>Label</th>
                    <th>Sound</th>
                    <th>Format</th>
                    <th>Release Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $dvd->title }}</td>
                    <td>{{ $dvd->rating_name }}</td>
                    <td>{{ $dvd->genre_name }}</td>
                    <td>{{ $dvd->label_name }}</td>
                    <td>{{ $dvd->sound_name }}</td>
                    <td>{{ $dvd->format_name }}</td>
                    <td>{{ $dvd->formatted_date }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    @if ($rt_data)
        <div class="row">
            <h3>Rotten Tomatoes Data</h3>

            <div class="col-xs-1">
                <img src="{{ $rt_data->posters->thumbnail }}">
            </div>

            <div class="col-xs-6 col-xs-offset-2">
                <table class="table table-striped">
                    <thead>
                        <th>Critic Score</th>
                        <th>Audience Score</th>
                        <th>Runtime</th>
                    </thead>
                    <tbody>
                        <td>{{ $rt_data->ratings->critics_score }}</td>
                        <td>{{ $rt_data->ratings->audience_score }}</td>
                        <td>{{ $rt_data->runtime }} minutes</td>
                    </tbody>
                </table>
            </div>

            <div class="col-xs-2 col-xs-offset-1">
                <table>
                    <thead>
                        <th>Cast</th>
                    </thead>
                    <tbody>
                        @foreach ($rt_data->abridged_cast as $cast)
                            <tr>
                                <td>{{ $cast->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <hr>

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

    <div class="row">
        <h2>Leave a new Review</h2>
    </div>

    <div class="row">
        <form method="post" action="/dvds/{{ $dvd->id }}/reviews">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="dvd_id" value="{{ $dvd->id }}">
            <div class="form-group">
                <label>Rating</label>
                <select class="form-control" name="rating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input name="title" class="form-control" value="{{ Request::old('title') }}">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input name="description" class="form-control" value="{{ Request::old('description') }}">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <div class="row">
        <h2>Reviews</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Rating</th>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->title }}</td>
                        <td>{{ $review->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
