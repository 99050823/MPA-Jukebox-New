<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model
{
    protected $table = 'genres'; 

    public static function getAllGenres () {
        return $genres = DB::table('genres')
            ->get();
    }
}
