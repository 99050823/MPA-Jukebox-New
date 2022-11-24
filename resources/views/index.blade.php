<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="index-container">
        <header>
            <h1>MPA-JukeBox</h1>

            <ul>
                <li><a href='/Account'>Account</a></li>
                <li><a href='#'>Home</a></li>
            </ul>
        </header>
        
        <p>Active User: {{$activeUser}}</p>

        <section>
            <h2>Playlists</h2>

            @if($check == true)
                <ul>
                    @foreach($playlists as $playlist)
                        <li><a href="/Playlist/PlaylistView/{{$playlist->playlist_name}}">{{$playlist->playlist_name}}</a></li>
                    @endforeach
                </ul>
            @else
                <p>{{$playlists}}</p>
            @endif

            <button><a href="/Playlist/CreateView">New Playlist</a></button>
            <button><a href="Playlist/AddSongView">Add songs</a></button>
        </section>

        <section>
            <h2>Genres</h2>

            <ul>
                @foreach($genres as $genre)
                    <li><a href="/Genre/GenreView/{{$genre->genre_name}}">{{$genre->genre_name}}</a></li>
                @endforeach
            </ul>
        </section>

        <section>
            <h2>Queue</h2>

            <ul>
                @foreach($queue as $selected)
                    <li>{{$selected->song_name}} - {{$selected->artist}}</li>
                @endforeach
            </ul>
        </section>
    </div>
</body>
</html>