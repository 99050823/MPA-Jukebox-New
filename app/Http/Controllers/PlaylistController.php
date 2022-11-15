<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SessionHelper;

class PlaylistController extends Controller
{
    public function createPlaylistView () {
        return view("createPlaylist");
    }

    public function createPlaylist (Request $req) {
        $username = SessionHelper::getUser();
        $playlistName = $req->name;

        SessionHelper::storeUserPlaylist($username, $playlistName);
        SessionHelper::getUserPlaylists($username);

        return redirect('/');
    }
}
