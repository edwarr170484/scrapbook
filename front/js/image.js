const bootstrap = require("bootstrap");
const request = require("./request.js");

class AlbumImage {
  constructor(modal) {
    this.modal = new bootstrap.Modal(modal);
  }

  edit() {
    this.modal.show();
  }

  closeModal() {
    document.getElementById("album-form").reset();
    this.modal.hide();
  }
}

module.exports = AlbumImage;
