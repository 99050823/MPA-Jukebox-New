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
        $queueDuration = 0;
        
        if ($queue == null) {
            $queueCount = 0;
        } else {
            $queueCount = count($queue);
            $queueDuration = MainController::calculateDuration($queue);
        }

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
            'queue' => $queue,
            'duration' => $queueDuration
        ]);
    }

    public static function calculateDuration ($queue) {
        $duration = 0;  
        $sum = strtotime('00:00:00');

        foreach($queue as $song) {
            $songTime = $song->duration;

            $timeInSec = strtotime($songTime) - $sum;
            $duration = $duration + $timeInSec;
        }
        
        $m = intval($duration / 60);
        $s = $duration - ($m * 60); 

        return "$m:$s";
    }

    public function generateQueue (Request $req) {
        
        if(SessionHelper::checkQueue() == false) {
            SessionHelper::createQueue();
        }

        $queue = SessionHelper::getQueue();
        $selectedSong = Song::getById($req->id);

        if (SessionHelper::checkForDuplicateQueue($queue, $selectedSong) == true) {
            echo "<p>Song is already added to the queue</p>";
            echo "<a href='/'>Return Home</a>";
        } else {
            SessionHelper::addToQueue($selectedSong);
            return redirect("/");
        }
    }

    public function deleteWholeQueue() {
        SessionHelper::forgetQueue();
        return redirect("/");
    }
}