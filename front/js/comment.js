const request = require("./request.js");
const validate = require("./validate.js");

class Comment {
    async add() {
        const form = document.querySelector("#comment-form");
        try {
            if (!validate(form)) {
                const formData = new FormData();
                formData.append("name", document.querySelector("#comment-name").value);
                formData.append("image", document.querySelector("#comment-image").value);
                formData.append("text", document.querySelector("#comment-text").value);

                let result = await request("post", "/comment/add", formData);

                if (result.response.ok && !result.result.error) {
                    document.querySelector("#image-comments").insertAdjacentHTML("beforeend",
                        `<div class="list-group-item list-group-item-action py-3 lh-sm">
                         <div class="d-flex w-100 justify-content-between">
                           <h5 class="mb-1">${result.result.name}</h5>
                           <small>${result.result.date_added}</small>
                         </div>
                         <p class="mb-1">${result.result.text}</p>
                       </div>`);
                }

                form.reset();
            }

        } catch (error) {
            console.log(error.message);
        }
    }
}

module.exports = Comment;