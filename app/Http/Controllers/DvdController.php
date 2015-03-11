<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Dvd;
use App\Models\Format;
use App\Models\Genre;
use App\Models\Label;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Sound;
use App\Services\RottenTomatoes;

class DvdController extends Controller {

    public function search()
    {
        $genres = Genre::all();
        $ratings = Rating::all();
        return view('search', [
            'genres' => $genres,
            'ratings' => $ratings
        ]);
    }

    public function create()
    {
        $formats = Format::all();
        $genres = Genre::all();
        $labels = Label::all();
        $ratings = Rating::all();
        $sounds = Sound::all();

        return view('create', [
            'formats' => $formats,
            'genres' => $genres,
            'labels' => $labels,
            'ratings' => $ratings,
            'sounds' => $sounds
        ]);
    }

    public function addDvd(Request $request)
    {
        $validation = Dvd::validate($request->all());

        if ($validation->passes()) {
            $dvd = new Dvd();
            $dvd->title = $request->input('title');
            $dvd->release_date = $request->input('release_date') . ' 00:00:00';
            $dvd->label_id = $request->input('label_id');
            $dvd->sound_id = $request->input('sound_id');
            $dvd->genre_id = $request->input('genre_id');
            $dvd->rating_id = $request->input('rating_id');
            $dvd->save();

            return redirect('/dvds/create')
                ->with('success', 'Dvd successfully saved');
        } else {
            return redirect('/dvds/create')
                ->withInput()
                ->withErrors($validation);
        }
    }

    public function results(Request $request)
    {
        $dvds = (new Dvd())->search($request->input('title'), $request->input('genre_id'),
            $request->input('rating_id'));
        $genres = Genre::all();
        $ratings = Rating::all();

        return view('results', [
            'title' => $request->input('title'),
            'genre_id' => $request->input('genre_id'),
            'rating_id' => $request->input('rating_id'),
            'genres' => $genres,
            'ratings' => $ratings,
            'dvds' => $dvds
        ]);
    }

    public function detail($id)
    {
        $dvd = (new DVD())->getById($id);
        $reviews = (new DVD())->getReviewsByDvdId($id);

        $rt_data = RottenTomatoes::search($dvd->title);

        // dd($rt_data);

        return view('detail', [
            'dvd' => $dvd,
            'reviews' => $reviews,
            'rt_data' => $rt_data
        ]);
    }

    public function addReview(Request $request)
    {
        $validation = Review::validate($request->all());

        if ($validation->passes()) {

            Review::create([
                'rating' => $request->input('rating'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'dvd_id' => $request->input('dvd_id')
            ]);

            return redirect('/dvds/' . $request->input('dvd_id'))->with('success', 'Review successfully saved');
        } else {
            // if data is invalid, redirect to /songs/new with error messages and old input
            return redirect('/dvds/' . $request->input('dvd_id'))
                ->withInput()
                ->withErrors($validation);
        }
    }

    public function dvdGenre($genre_name)
    {
        $genre = Genre::where('genre_name', '=', urldecode($genre_name))->firstOrFail();

        $dvds = Dvd::with('rating', 'genre', 'label')
            ->whereHas('genre', function($q) use ($genre)
            {
                $q->where('genre_id', '=', $genre->id);
            })
            ->get();

        // return $dvds;

        return view('genre', [
            'genre' => $genre,
            'dvds' => $dvds
        ]);
    }

}