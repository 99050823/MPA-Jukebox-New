<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Playlist;
use App\Models\Genre;
use App\Models\Song;
use Illuminate\Support\Facades\Session;
use App\SessionHelper;

class MainController extends Controller
{
    // Load the landing page
    public function loadIndex () {
        //GET genres from DB
        $genres = Genre::getAllGenres();

        //GET the logged in user
        $activeUser = SessionHelper::getUser();

        //GET playlists from session
        $check = SessionHelper::checkUserPlaylists($activeUser);

        //GET the queue from session
        $queue = SessionHelper::getQueue();
        
        if ($queue == null) {
            $queueCount = 0;
        } else {
            $queueCount = count($queue);
        }
        
        $readableQueue = SessionHelper::createArray($queue, $queueCount);  

        if ($check == true) {
            $playlists = SessionHelper::getUserPlaylists($activeUser);
            if ($playlists !== []) {
                $count = count($playlists);
            } else {
                $playlists = "No Playlist created...";
                $count = 0;
                $check = false;
            }
        } else {
            $playlists = "No Playlist created...";
            $count = 0;
        }
    
        return view('index', [
            'playlists' => $playlists,
            'genres' => $genres,
            'activeUser' => $activeUser,
            'check' => $check,
            'length' => $count,
            'queue' => $readableQueue
        ]);
    }

    public function generateQueue (Request $req) {
        
        if (SessionHelper::getUser() == null) {
            echo "<p>You need to login to create a queue</p>";
            echo "<a href='/Account/Login'>login</a>";
        } else {
            if(SessionHelper::checkQueue() == false) {
                SessionHelper::createQueue();
            }

            $queue = SessionHelper::getQueue();
            $queueCount = count($queue);

            $readableQueue = SessionHelper::createArray($queue, $queueCount);
            $selectedSong = Song::getById($req->id);

            if (SessionHelper::checkForDuplicate($readableQueue, $selectedSong) == true) {
                echo "<p>Song is already added to the queue</p>";
                echo "<a href='/'>Return Home</a>";
            } else {
                SessionHelper::addToQueue($selectedSong);
                return redirect("/");
            }
        }   
    }
}