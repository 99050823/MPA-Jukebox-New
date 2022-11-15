<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Playlist;
use App\Models\Genre;
use App\Models\Song;
use Illuminate\Support\Facades\Session;
use App\SessionHelper;

class MainController extends Controller
{
    // Load the landing page
    public function loadIndex () {
        //GET genres from DB
        $genres = ['Metal', 'Rock', 'Pop'];

        //GET playlists from session
        $playlists = ['Playlist', 'test', 'Sjaak'];

        $activeUser = SessionHelper::getUser();

        return view('index', [
            'playlists' => $playlists,
            'genres' => $genres,
            'activeUser' => $activeUser,
        ]);
    }
}