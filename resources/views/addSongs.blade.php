<div>
    <h2>Add songs to a playlist</h2>

    <section>
        <h3>Queue</h3>

        <ul>
            @foreach($queue as $selectedSong)
                <li>{{$selectedSong->song_name}}</li>
            @endforeach
        </ul>
    </section>

    <section>
        <h3>Playlists</h3>

        <ul>
            @foreach($playlists as $playlist)
                <li><a href='/Playlist/AddSong/{{$playlist->playlist_name}}'>{{$playlist->playlist_name}}</a></li>
            @endforeach
        </ul>
    </section>
</div>