<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SessionHelper;
use App\Models\Song;

class PlaylistController extends Controller
{
    public function createPlaylistView () {
        return view("createPlaylist");
    }

    public function createPlaylist (Request $req) {
        $username = SessionHelper::getUser();
        $playlistName = $req->name;

        $playlistObj = (object) [
            'playlist_name' => $playlistName,
            'attached_songs' => array()
        ];

        SessionHelper::storeUserPlaylist($username, $playlistObj);

        return redirect('/');
    }

    public function playlistView (Request $req) {
        $username = SessionHelper::getUser();
        $playlistName = $req->name;
        
        return view('playlist', [
            'playlist' => $playlistName,
        ]);
    }

    public function deletePlaylist (Request $res) {
        $username = SessionHelper::getUser();
        SessionHelper::deletePlaylist($username, $res->name);

        return "<div>
            <p>You've deleted playlist: " . $res->name . "</p>
            <a href='/'>Home</a>
        </div>";
    }

    public function renamePlaylistView (Request $res) {
        return view('editPlaylist', [
            'playlist' => $res->name,
        ]);
    }

    public function renamePlaylist (Request $res) {
        $username = SessionHelper::getUser();
        SessionHelper::renamePlaylist($username, $res->name, $res->changeName);
        return redirect("/Playlist/PlaylistView/" . $res->changeName);
    }

    public function addSongView () {
        $user = SessionHelper::getUser();
        $playlists = SessionHelper::getUserPlaylists($user);
        $queue = SessionHelper::getQueue();
        
        $queueCount = count($queue);
        $newQueue = SessionHelper::createArray($queue, $queueCount);

        return view('addSongs', [
            'queue' => $newQueue,
            'playlists' => $playlists
        ]);
    }

    public function addSong (Request $req) {
        dd("test");
    }
}
