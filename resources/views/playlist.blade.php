<div>
    <h2>{{$playlist}}</h2>

    @if($check == false)
        <p>Click on a song to delete it.</p>

        <ul>
            @foreach($songs as $song)
                <li><a href="/Playlist/DeleteSong/{{$song->song_name}}/{{$playlist}}">{{$song->song_name}}</a></li>
            @endforeach
        </ul>

        <p>Duration: {{$duration}}</p>
    @else
        <p>{{$songs}}</p>
    @endif

    <a href="/Playlist/Delete/{{$playlist}}">Delete</a>
    <a href="/Playlist/RenameView/{{$playlist}}">Rename</a>
    <a href="/">Home</a>
</div>