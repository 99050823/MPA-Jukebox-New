<?php

namespace App;

use Illuminate\Support\Facades\Session;

class SessionHelper {

    public static function storeUser ($user) {
        session()->put("Username", $user->username);
    }

    public static function getUser () {
        $username = session()->get("Username");
        return $username;
    }

    public static function logoutUser () {
        session()->forget("Username");
    }

} 