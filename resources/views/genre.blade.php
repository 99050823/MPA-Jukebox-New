<div>
    <h1>{{$genre}}</h1>
    <a href="/">Home</a>

    @if($check !== true)
        <ul>
            @foreach($songs as $song) 
                <li><a href="/Selected/{{$song->id}}">{{$song->song_name}}</a></li>
            @endforeach
        </ul>
    @else
        <p>{{$songs}}</p>
    @endif
</div>