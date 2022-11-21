<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

class GenreController extends Controller
{
    public function genreView(Request $req) {
        
        //Get all songs with selected genre
        $songs = Song::getSongsByGenre($req->name);
        $check = false;

        if (count($songs) == 0) {
            $check = true;
            $songs = "No songs available...";
        }

        return view('genre', [
            'songs' => $songs,
            'genre' => $req->name,
            'check' => $check,
        ]);
    }
}
