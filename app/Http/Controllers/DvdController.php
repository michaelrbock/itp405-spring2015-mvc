<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Dvd;
use App\Models\Review;

class DvdController extends Controller {

    public function search()
    {
        $genres = (new Dvd())->genres();
        $ratings = (new Dvd())->ratings();
        return view('search', [
            'genres' => $genres,
            'ratings' => $ratings
        ]);
    }


    public function results(Request $request)
    {
        $dvds = (new Dvd())->search($request->input('title'), $request->input('genre_id'),
            $request->input('rating_id'));
        $genres = (new Dvd())->genres();
        $ratings = (new Dvd())->ratings();

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

        return view('detail', [
            'dvd' => $dvd,
            'reviews' => $reviews
        ]);
    }

    public function addReview(Request $request)
    {
        $validation = Review::validate($request->all());

        if ($validation->passes()) {
            // insert record into db
            // redirect back to /songs/new

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

}