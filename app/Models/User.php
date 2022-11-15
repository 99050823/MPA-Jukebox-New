<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;

class User extends Model
{   
    protected $table = 'users'; 

    public static function checkUser($username) {
        $user = DB::table('users')
            ->where('username', '=', $username)
            ->first();

        return $user;
    }

    public static function insertUser ($username, $password) {
        DB::table('users')->insert(
            [
                'username' => $username, 
                'password' => Hash::make($password),
            ]
        );
    }
}
