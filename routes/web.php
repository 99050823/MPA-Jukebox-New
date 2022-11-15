<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PlaylistController;

//Main Controller -------------------------------
Route::get('/', [MainController::class, 'loadIndex']);

//Playlist Controller ---------------------------
Route::get('/Playlist/CreateView', [PlaylistController::class, 'createPlaylistView']);
Route::post('/Playlist/Create', [PlaylistController::class, 'createPlaylist']);

//Account Controller ----------------------------
Route::get('/Account', [AccountController::class, 'accountInfo']);
Route::get('/Account/Login', [AccountController::class, 'loginView']);
Route::post('/Account/Login/Auth', [AccountController::class, 'login'])->middleware('customAuthLogin');
Route::get('/Account/Logout', [AccountController::class, 'logout']);

Route::get('/Account/Register', [AccountController::class, 'registerView']);
Route::post('/Account/Register/Auth', [AccountController::class, 'register'])->middleware('customAuthRegister');
