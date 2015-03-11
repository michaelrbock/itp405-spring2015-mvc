<?php namespace App\Services;

class RottenTomatoes {

    public static function search($dvd_title)
    {
        $dvd_title = urlencode(strtolower($dvd_title));

        if (\Cache::has("rt-$dvd_title")) {
            $json_string = \Cache::get("rt-$dvd_title");
        } else {
            $url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=wep2twcdnse3q58wypnephew&q=$dvd_title";
            $json_string = file_get_contents($url);

            \Cache::put("rt-$dvd_title", $json_string, 60);
        }

        $rt_data = json_decode($json_string);
        $movies = $rt_data->movies;

        foreach ($movies as $movie) {
            if (trim(strtolower($movie->title)) == strtolower(trim(urldecode($dvd_title)))) {
                return $movie;
            }
        }
    }

}