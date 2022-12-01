<div>
    <h1>{{$song->song_name}} - {{$song->artist}}</h1>
    <hr>

    <ul>
        <li>Duration: {{$duration}}</li>
        <li>Genre: {{$song->genre}}</li>
    </ul>

    <a href="/Genre/GenreView/{{$song->genre}}">Return</a>
    <a href="/Selected/{{$song->id}}">Select Song</a>
</div>