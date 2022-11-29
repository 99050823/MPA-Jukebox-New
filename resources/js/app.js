const newBttn = document.getElementById("newButton");
const addBttn = document.getElementById("addButton");

newBttn.addEventListener("click", () => {
    window.location.href = "/Playlist/CreateView";
});

addBttn.addEventListener("click" , () => {
    window.location.href = "/Playlist/AddSongView";
})
