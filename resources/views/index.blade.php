<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <style>
    </style>
</head>
<body>
    <div>
        <header>
            <h1>MPA-JukeBox</h1>
            <p>Active User: {{$activeUser}}</p>

            <ul>
                <li><a href='/Account'>Account</a></li>
                <li><a href='#'>Home</a></li>
            </ul>
        </header>   

        <section>
            <h2>Playlists</h2>

            @if($check == true)
                <ul>
                @for($i = 0; $i < $length; $i++)
                    <li><a href="/Playlist/PlaylistView/{{$playlists[$i]}}">{{$playlists[$i]}}</a></li>
                @endfor
                </ul>
            @else
                <p>{{$playlists}}</p>
            @endif
        </section>

        <section>
            <h2>Genres</h2>

            <ul>
                @foreach($genres as $genre)
                    <li><a href="#">{{$genre}}</a></li>
                @endforeach
            </ul>
        </section>

        <a href="/Playlist/CreateView">New Playlist</a>
    </div>
</body>
</html>