<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\GenreController;

//Main Controller -------------------------------
Route::get('/', [MainController::class, 'loadIndex']);
Route::get('/Selected/{id}', [MainController::class, 'generateQueue']);

//Playlist Controller ---------------------------
Route::get('/Playlist/CreateView', [PlaylistController::class, 'createPlaylistView']);
Route::post('/Playlist/Create', [PlaylistController::class, 'createPlaylist']);
Route::get('/Playlist/PlaylistView/{name}', [PlaylistController::class, 'playlistView']);
Route::get('/Playlist/Delete/{name}', [PlaylistController::class, 'deletePlaylist']);
Route::get('/Playlist/RenameView/{name}', [PlaylistController::class, 'renamePlaylistView']);
Route::post('/Playlist/Rename/{name}', [PlaylistController::class, 'renamePlaylist']);
Route::get('/Playlist/AddSongView', [PlaylistController::class, 'addSongView']);
Route::get('/Playlist/AddSong/{playlist}', [PlaylistController::class, 'addSong']);

//Genre Controller ------------------------------
Route::get('/Genre/GenreView/{name}', [GenreController::class, 'genreView']);

//Account Controller ----------------------------
Route::get('/Account', [AccountController::class, 'accountInfo']);
Route::get('/Account/Login', [AccountController::class, 'loginView']);
Route::post('/Account/Login/Auth', [AccountController::class, 'login'])->middleware('customAuthLogin');
Route::get('/Account/Logout', [AccountController::class, 'logout']);

Route::get('/Account/Register', [AccountController::class, 'registerView']);
Route::post('/Account/Register/Auth', [AccountController::class, 'register'])->middleware('customAuthRegister');

//Error Controller -------------------------------
Route::get('/error/password', [ErrorController::class, 'errorPassword']);
Route::get('/error/username', [ErrorController::class, 'errorUsername']);
Route::get('/error/noUniqueUsername', [ErrorController::class, 'errorUniqueUsername']);

