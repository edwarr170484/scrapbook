const Javatta = require("./javatta.js");
const Album = require("./album.js");
const AlbumImage = require("./image.js");
const Comment = require("./comment.js");

window.album = new Album("#albumModal");
window.albumImage = new AlbumImage("#imageModal");
window.comment = new Comment();

document.addEventListener("DOMContentLoaded", (event) => {
  new Javatta(document.getElementById("attachment"), {
    maxFilesNumber: 100,
    disallowTypes: ["exe", "bat", "js", "vbs", "com", "sh", "ps", "mth"],
  });
});
