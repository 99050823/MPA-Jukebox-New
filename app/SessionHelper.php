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

    public static function checkQueue() {
        return session()->has("Selected");
    }

    public static function createQueue() {
        session()->put("Selected", []);
    }

    public static function addToQueue($song) {
        session()->push("Selected", $song);
    }

    public static function getQueue() {
        return session()->get("Selected");
    }

    public static function forgetQueue() {
        session()->forget("Selected");
    }
} 