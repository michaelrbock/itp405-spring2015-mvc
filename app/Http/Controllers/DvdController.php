<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Dvd;

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
}