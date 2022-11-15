<div>
    <h2>Create a new playlist</h2>

    <form method="post" action="/Playlist/Create">
        @csrf
        <label for="name">Playlist name: </label>
        <input type="text" name="name"> <br>

        <input type="submit" value="Submit">
    </form>
</div>