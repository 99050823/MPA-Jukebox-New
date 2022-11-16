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

        $activeUser = SessionHelper::getUser();

        //GET playlists from session
        $check = SessionHelper::checkUserPlaylists($activeUser);
    
        if ($check == true) {
            $playlists = SessionHelper::getUserPlaylists($activeUser);
            if ($playlists !== []) {
                $count = count($playlists);
            } else {
                $playlists = "No Playlist created...";
                $count = 0;
                $check = false;
            }
        } else {
            $playlists = "No Playlist created...";
            $count = 0;
        }
    
        return view('index', [
            'playlists' => $playlists,
            'genres' => $genres,
            'activeUser' => $activeUser,
            'check' => $check,
            'length' => $count
        ]);
    }
}