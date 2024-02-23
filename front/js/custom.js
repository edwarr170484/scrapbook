const Javatta = require("./javatta.js");
const Album = require("./album.js");
const AlbumImage = require("./image.js");

window.album = new Album("#albumModal");
window.albumImage = new AlbumImage("#imageModal");

document.addEventListener("DOMContentLoaded", (event) => {
  new Javatta(document.getElementById("attachment"), {
    disallowTypes: ["exe", "bat", "js", "vbs", "com", "sh", "ps", "mth"],
  });
});
