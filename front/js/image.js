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
        <div class="btn-group btn-group-sm rate-buttons-${id}" role="group">
          <button type="button" class="btn btn-danger" onclick="albumImage.rate(${id}, 'dislikes')"><i class="far fa-thumbs-down"></i> ${result.result.dislikesCount}</button>
          <button type="button" class="btn btn-success" onclick="albumImage.rate(${id}, 'likes')"><i class="far fa-thumbs-up"></i> ${result.result.likesCount}</button>
        </div>`;

      let comments = ``;

      if (result.result.comments.length > 0) {
        result.result.comments.forEach((comment) => {
          comments += `<div class="list-group-item list-group-item-action py-3 lh-sm">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1 text-sm">${comment.name}</h5>
                          <small>${comment.date_added}</small>
                        </div>
                        <p class="mb-1">${comment.text}</p>
                      </div>`;
        });
      } else {
        comments = `Комментариев пока нет`;
      }

      const imageInfo = `<div><h2>${result.result.caption}</h2>
                         <small><i>${result.result.description}</i></small></div>
                         <div class="image-comments list-group list-group-flush flex-grow-1" id="image-comments">${comments}</div>`;

      document.querySelector("#image-info").innerHTML = imageInfo;
      document.querySelector("#comment-image").value = id;

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

  async rate(imageId, type) {
    let formData = new FormData();
    formData.append("rate-type", type);
    formData.append("rate-image", imageId);

    let result = await request("post", `/album/images/rate`, formData);

    if (result.response.ok && result.result) {
      let buttons = document.querySelectorAll(`.rate-buttons-${imageId}`);

      if (buttons) {
        [...buttons].forEach((button) => {
          button.innerHTML = `<button type="button" class="btn btn-danger" onclick="albumImage.rate(${result.result.id}, 'dislikes')"><i class="far fa-thumbs-down"></i> ${result.result.dislikesCount}</button>
      <button type="button" class="btn btn-success" onclick="albumImage.rate(${result.result.id}, 'likes')"><i class="far fa-thumbs-up"></i> ${result.result.likesCount}</button>`;
        });
      }
    }
  }

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
