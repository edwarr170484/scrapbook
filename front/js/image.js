const bootstrap = require("bootstrap");
const request = require("./request.js");

class AlbumImage {
  constructor(modal) {
    this.modal = new bootstrap.Modal(modal);
    this.singleModal = new bootstrap.Modal("#singleImageModal");
  }

  async single(id) {
    let result = await request("get", `/album/image?id=${id}`);

    if (result.response.ok && result.result) {
      document.querySelector("#image-preview").innerHTML = `
        <img src="${result.result.path}" alt="${result.result.caption}" title="${result.result.caption}" />
        <div class="btn-group btn-group-sm" role="group">
          <button type="button" class="btn btn-danger" onclick="albumImage.rate(${id}, 'dislikes')"><i class="far fa-thumbs-down"></i> ${result.result.dislikes}</button>
          <button type="button" class="btn btn-success" onclick="albumImage.rate(${id}, 'likes')"><i class="far fa-thumbs-up"></i> ${result.result.likes}</button>
        </div>`;

      let comments = ``;

      if (result.result.comments) {
        result.result.comments.forEach((comment) => {
          comments += `<div class="list-group-item list-group-item-action py-3 lh-sm">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">${comment.name}</h5>
                          <small>${comment.date_added}</small>
                        </div>
                        <p class="mb-1">${comment.text}</p>
                      </div>`;
        });
      } else {
        comments = `Комментариев пока нет`;
      }

      const imageInfo = `<h2>${result.result.caption}</h2>
                         <small><i>${result.result.description}</i></small>
                         <div class="image-comments list-group list-group-flush border-bottom flex-grow-1">${comments}</div>`;

      document.querySelector("#image-info").innerHTML = imageInfo;

      this.singleModal.show();
    }
  }

  async edit(id, album_id) {
    let result = await request("get", `/album/image?id=${id}`);

    if (result.response.ok && result.result) {
      let image = result.result;
      if (image.id) {
        document.querySelector("#image-id").value = image.id;
        document.querySelector("#image-caption").value = image.caption;
        document.querySelector("#image-description").value = image.description;
        document.querySelector("#redirect").value = `/album?id=${album_id}`;

        this.modal.show();
      }
    }
  }

  rate(id, type) {}

  async delete(id) {
    if (
      confirm(
        "Вы действительно хотите удалить это изображение и связанные с ним данные?"
      )
    ) {
      try {
        const formData = new FormData();
        formData.append("id", id);

        let result = await request("post", "/album/images/delete", formData);

        if (result.response.ok && !result.result.error) {
          window.location.reload();
        }
      } catch (error) {
        console.log(error.message);
      }
    }
  }

  closeModal() {
    document.getElementById("image-form").reset();
    this.modal.hide();
  }
}

module.exports = AlbumImage;
