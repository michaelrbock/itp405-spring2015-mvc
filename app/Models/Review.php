<?php namespace App\Models;

use DB;
use Validator;

class Review {

    public static function validate($input)
    {
        return $validation = Validator::make($input, [
            'rating' => 'required|integer',
            'title' => 'required',
            'description' => 'required',
            'dvd_id' => 'required|integer'
        ]);
    }

    public static function create($data)
    {
        return DB::table('reviews')->insert($data);
    }

}