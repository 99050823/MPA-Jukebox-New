<div>
    <h2>Add songs to a playlist</h2>

    <section>
        <h3>{{$queueTitle}}</h3>

        <ul>
            @if($check == true)
                @foreach($queue as $selectedSong)
                    <li>{{$selectedSong->song_name}}</li>
                @endforeach
            @else 
                <p>{{$queue}}</p>
            @endif
        </ul>
    </section>

    <section>
        <h3>{{$playlistTitle}}</h3>

        <ul>
            @if($check == true)
                @foreach($playlists as $playlist)
                    <li><a href='/Playlist/AddSong/{{$playlist->playlist_name}}'>{{$playlist->playlist_name}}</a></li>
                @endforeach
            @endif
        </ul>
    </section>

    <a href="/">Home</a>
</div>