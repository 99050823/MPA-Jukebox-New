<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SessionHelper;
use App\Models\Song;
use App\Http\Controllers\MainController;

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
        $songs = SessionHelper::getSpecificPlaylist($username, $playlistName);
        $duration = 0;
        $check = false;

        if ($songs == null) {
            $check = true;
            $songs = "No songs in this playlist...";
        } else {
            $duration = MainController::calculateDuration($songs);
        }

        return view('playlist', [
            'playlist' => $playlistName,
            'songs' => $songs,
            'check' => $check,
            'duration' => $duration
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
        $songs = SessionHelper::getSpecificPlaylist($username, $res->name);
        SessionHelper::renamePlaylist($username, $res->name, $res->changeName, $songs);

        return redirect("/Playlist/PlaylistView/" . $res->changeName);
    }

    public function addSongView () {
        $user = SessionHelper::getUser();
        $playlists = SessionHelper::getUserPlaylists($user);
        $queue = SessionHelper::getQueue();
        $queueTitle = "";
        $playlistTitle = "";
        
        if ($user == null) {
            $queue = "No user logged in...";
            $check = false;
        } else {
            if ($queue == []) {
                $check = false;
                $queue = "No songs selected...";
            } else {
                if ($playlists !== []) {    
                    $check = true;
                    $queueTitle = "Queue";
                    $playlistTitle = "Playlists";
                } else {
                    $check = false;
                    $queue = "No playlist created...";
                }
            }
        }

        return view('addSongs', [
            'queue' => $queue,
            'playlists' => $playlists,
            'check' => $check,
            'queueTitle' => $queueTitle,
            'playlistTitle' => $playlistTitle,
        ]);
    }

    public function addSong (Request $req) {
        $username = SessionHelper::getUser();

        SessionHelper::addSong($req->playlist, $username);
        SessionHelper::forgetQueue();

        return redirect('/Playlist/PlaylistView/' . $req->playlist);
    }

    public function deleteSingleSong (Request $req) {
        $songName = $req->songName;
        $playlistName = $req->playlistName;
        $user = SessionHelper::getUser();

        SessionHelper::deleteSingleSong($songName, $playlistName, $user);
        return redirect("/Playlist/PlaylistView/" . $playlistName);
    }
}
