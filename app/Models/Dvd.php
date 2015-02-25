<?php namespace App\Models;

use DB;

class Dvd {

    public function search($title = '', $genre_id = '', $rating_id = '')
    {
        $query =  DB::table('dvds')
            ->select('dvds.id', 'dvds.title', 'dvds.release_date',
                'ratings.rating_name', 'genres.genre_name', 'labels.label_name',
                'sounds.sound_name', 'formats.format_name')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id');

        // conditional where clause
        if ($title) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }
        if ($genre_id && $genre_id != '0' && is_numeric($genre_id)) {
            $query->where('genre_id', '=', $genre_id);
        }
        if ($rating_id && $rating_id != '0' && is_numeric($rating_id)) {
            $query->where('rating_id', '=', $rating_id);
        }

        $query->orderBy('title', 'asc');

        $dvds = $query->get();

        foreach($dvds as $dvd) {
            $dvd->formatted_date = date_format(date_create($dvd->release_date), 'M d, Y');
        }

        return $dvds;
    }

    public function getByID($id)
    {
        $query =  DB::table('dvds')
            ->select('dvds.id', 'dvds.title', 'dvds.release_date',
                'ratings.rating_name', 'genres.genre_name', 'labels.label_name',
                'sounds.sound_name', 'formats.format_name')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id')
            ->where('dvds.id', '=', $id);
        $dvd = $query->first();
        $dvd->formatted_date = date_format(date_create($dvd->release_date), 'M d, Y');

        return $dvd;
    }

    public function getReviewsByDvdId($id)
    {
        $query =  DB::table('dvds')
            ->select('reviews.title', 'reviews.description', 'reviews.rating')
            ->join('reviews', 'dvds.id', '=', 'reviews.dvd_id')
            ->where('dvds.id', '=', $id)
            ->where('reviews.dvd_id', '=', $id);
        return $query->get();
    }

    public function genres()
    {
        $query = DB::table('genres');
        return $query->get();
    }

    public function ratings()
    {
        $query = DB::table('ratings');
        return $query->get();
    }
}