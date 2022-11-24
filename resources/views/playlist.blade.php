<div>
    <h2>{{$playlist}}</h2>

    @if($check == false)
        <ul>
            @foreach($songs as $song)
                <li>{{$song->song_name}}</li>
            @endforeach
        </ul>
    @else
        <p>{{$songs}}</p>
    @endif

    <a href="/Playlist/Delete/{{$playlist}}">Delete</a>
    <a href="/Playlist/RenameView/{{$playlist}}">Rename</a>
    <a href="/">Home</a>
</div>