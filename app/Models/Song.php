<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Song extends Model
{
    protected $table = 'songs'; 

    public static function getSongsByGenre ($genre) {
        return $songs = DB::table('songs')
            ->where('genre', $genre)
            ->get();
    }

    public static function getById ($id) {
        return $song = DB::table('songs')
            ->where('id', $id)
            ->get();
    }
}
