<?php

namespace App;

use Illuminate\Support\Facades\Session;

class SessionHelper {

    public static function storeUser ($user) {
        session()->put("Username", $user->username);
        session()->put($user->username . " Playlists", []);
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

} 