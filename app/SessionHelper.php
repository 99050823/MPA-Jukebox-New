<?php

namespace App;

use Illuminate\Support\Facades\Session;

class SessionHelper {

    public static function storeUser ($user) {
        session()->put("Username", $user->username);
        $check = session()->has($user->username . " Playlists");

        if ($check !== true) {
            session()->put($user->username . " Playlists", []);
        }
    }

    public static function getUser () {
        $username = session()->get("Username");
        return $username;
    }

    public static function logoutUser () {
        session()->forget("Username");
    }

    public static function storeUserPlaylist($username, $playlist) {
        session()->push($username . " Playlists", $playlist);
    }

    //Get all playlist based on a logged in user
    public static function getUserPlaylists($username) {
        return session()->get($username . " Playlists");
    }

    //Get songs from the playlist by name
    public static function getSpecificPlaylist($username, $playlistName) {
        $playlists = session()->get($username . " Playlists");
        $key = array_search($playlistName, $playlists);

        if ($playlists[$key]->attached_songs == []) {
            return null;
        } else {
            return $playlists[$key]->attached_songs;
        }
    
    }

    //Check if current user has made any playlists
    public static function checkUserPlaylists($username) {
        return session()->has($username . " Playlists");
    }

    //Delete playlist by name
    public static function deletePlaylist($username, $playlistName) {
        $playlists = session()->get($username . " Playlists");
        $key = array_search($playlistName, $playlists);
        
        unset($playlists[$key]);
        $newArr = array_values($playlists);
        
        session()->forget($username . " Playlists");
        session()->put($username . " Playlists", $newArr);
    }

    //Change playlist name 
    public static function renamePlaylist($username, $playlistName, $newName, $songs) {
        SessionHelper::deletePlaylist($username, $playlistName);
        
        $newPlaylistObj = (object) [
            "playlist_name" => $newName,
            "attached_songs" => $songs
        ];

        SessionHelper::storeUserPlaylist($username, $newPlaylistObj);
    }

    //Check if a queue exists
    public static function checkQueue() {
        return session()->has("Selected");
    }

    //Create a new queue
    public static function createQueue() {
        session()->put("Selected", []);
    }

    //Add a song object to the queue
    public static function addToQueue($song) {
        session()->push("Selected", $song);
    }

    //Get the queue
    public static function getQueue() {
        $readableArray = array();
        $queue = session()->get("Selected");

        if ($queue !== null) {
            $count = count($queue);

            for ($i=0; $i < $count; $i++) { 
                array_push($readableArray, $queue[$i][0]);
            }   
        } else {
            $readableArray = [];
        }

        return $readableArray;
    }

    //Delete the queue
    public static function forgetQueue() {
        session()->forget("Selected");
    }

    //Check for existing song in the queue 
    public static function checkForDuplicateQueue($queue, $song) {
        $song = $song[0];

        foreach($queue as $existingSong) {
            if ($existingSong == $song) {
                return true;
            } 
        }

        return false;
    }

    public static function addSong($playlistName, $user) {
        $playlistArr = SessionHelper::getUserPlaylists($user);
        $queue = SessionHelper::getQueue();

        foreach ($playlistArr as $playlist) {
            if ($playlist->playlist_name == $playlistName) {
                foreach($queue as $song) {
                    if (!in_array($song, $playlist->attached_songs)) {
                        array_push($playlist->attached_songs, $song);  
                    } 
                }
            } 
        }
    }

    public static function deleteWholeSession () {
        session()->flush();
    }
} 