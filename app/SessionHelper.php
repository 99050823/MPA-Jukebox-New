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
    public static function renamePlaylist($username, $playlistName, $newName) {
        $playlists = session()->get($username . " Playlists");
        $key = array_search($playlistName, $playlists);

        unset($playlists[$key]);
        $newArr = array_values($playlists);
        array_push($newArr, $newName);

        session()->forget($username . " Playlists");
        session()->put($username . " Playlists", $newArr);
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
        return session()->get("Selected");
    }

    //Delete the queue
    public static function forgetQueue() {
        session()->forget("Selected");
    }

    //Create a clearer array
    public static function createArray($queue, $count) {
        $readableArray = array();

        for ($i=0; $i < $count; $i++) { 
            array_push($readableArray, $queue[$i][0]);
        }

        return $readableArray;
    }

    //Check for existing song in the queue or playlist
    //Location: Playlist or Queue
    public static function checkForDuplicate($location, $song) {
        $song = $song[0];

        foreach($location as $existingSong) {
            if ($existingSong == $song) {
                return true;
            } 
        }

        return false;
    }
} 