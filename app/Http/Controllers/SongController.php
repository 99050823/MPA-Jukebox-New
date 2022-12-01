<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Http\Controllers\MainController;

class SongController extends Controller
{
    public function songView (Request $req) {
        $song = Song::getById($req->id);
        $duration = MainController::calculateDuration($song);

        return view('song', [
            'song' => $song[0],
            'duration' => $duration
        ]);
    }
}
