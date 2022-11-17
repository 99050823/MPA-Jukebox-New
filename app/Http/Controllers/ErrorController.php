<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function errorPassword() {
        return view('error', [
            'errorText' => 'Wrong password',
            'link' => '/Account/Login',
            'linkText' => 'Return to the login page'
        ]);
    }

    public function errorUsername() {
        return view('error', [
            'errorText' => 'No user found with this username',
            'link' => '/Account/Login',
            'linkText' => 'Return to the login page'
        ]);
    }

    public function errorUniqueUsername() {
        return view('error', [
            'errorText' => 'Username already exists',
            'link' => '/Account/Register',
            'linkText' => 'Return to the register page'
        ]);
    }
}
