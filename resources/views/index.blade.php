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
            <div class="item1">
                <h1>MPA-JukeBox</h1>
            </div>

            <div class="item2">
                <ul>
                    <li><a href='/Account'>Account</a></li>
                    <li><a href='#'>Home</a></li>
                    <li>Active User: {{$activeUser}}</li>
                </ul>
            </div>
        </header> 

        <div class="main-container">
            <section>
                <h2>Playlists</h2>

                @if($check == true)
                    <ul>
                        @foreach($playlists as $playlist)
                            <a href="/Playlist/PlaylistView/{{$playlist->playlist_name}}">
                                <li>{{$playlist->playlist_name}}</li>
                            </a>
                        @endforeach
                    </ul>
                @else
                    <p>{{$playlists}}</p>
                @endif

                <button><a href="/Playlist/CreateView">New Playlist</a></button>
                <button><a href="Playlist/AddSongView">Add songs</a></button>

                <section class="queue-container">
                    <h2>Queue</h2>
                    <hr>

                    <ul>
                        @foreach($queue as $selected)
                            <li>{{$selected->song_name}} - {{$selected->artist}}</li>
                        @endforeach
                    </ul>
                </section>
            </section>

            <section>
                <h2>Genres</h2>

                <ul>
                    @foreach($genres as $genre)
                        <a href="/Genre/GenreView/{{$genre->genre_name}}">
                            <li>{{$genre->genre_name}}</li>
                        </a>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>
</body>
</html>