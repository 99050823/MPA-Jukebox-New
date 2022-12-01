<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SessionHelper;
use App\Models\User;

class AccountController extends Controller
{
    public function accountInfo() {
        $user = SessionHelper::getUser();
        
        if ($user !== null) {
            $viewData = $user; 
            $linkStr = "Account/Logout";
            $linkText = "Logout";
            $registerLink = "";
        } else {
            $viewData = "No user logged in...";
            $linkStr = "/Account/Login";
            $linkText = "Login";
            $registerLink = "<a href='/Account/Register'><li>Register</li></a>";
        }

        return view('account', [
            'accountText' => $viewData,
            'link' => $linkStr,
            'linkText' => $linkText,
            'registerLink' => $registerLink
        ]);
    }

    public function loginView() {
        return view('login');
    }

    public function login() {
        return redirect('Account');
    }

    public function registerView() {
        return view('register');
    }

    public function register() {
        return redirect('Account/Login');
    }

    public function logout() {
        SessionHelper::logoutUser();
        SessionHelper::forgetQueue();
        return redirect('Account');
    }
}
