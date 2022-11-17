<div>
    <h2>Edit Playlist</h2>

    <form action="/Playlist/Rename/{{$playlist}}" method="post">
        @csrf
        <label for="changeName">Change Playlist Name: </label>
        <input type="text" name="changeName"> <br>

        <input type="submit" value="Submit">
    </form>
</div>