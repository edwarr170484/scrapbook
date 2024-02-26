class Javatta {
  /**
   * Constructor for uploader
   * @param {Object} element - DOM element which converted to dropzone, usually it is input[type="file"] control
   * @param {Object} options - options object merged with default options object
   */

  constructor(element, options) {
    this.element = element;

    this.options = Object.assign(
      {
        maxFilesNumber: 3,
        maxTotalUploadSize: 10e6,
        disallowTypes: [],
      },
      options
    );

    this.totalSize = 0;
    this.uploads = new DataTransfer();

    /* render html for javatta element dropzone */
    this.template = {
      container: document.createElement("div"),
      label: document.createElement("div"),
      input: element,
      error: document.createElement("div"),
    };

    this.template.container.classList.add("javatta");
    this.template.label.classList.add("javatta-label");
    this.render();
    this.template.container.appendChild(this.template.label);

    this.template.input.replaceWith(this.template.container);
    this.template.container.appendChild(this.element);

    this.template.error.classList.add("javatta-error");
    this.template.container.appendChild(this.template.error);

    this.element.addEventListener("change", (event) => {
      this.update().checkFilesNumber().checkTotalSize().render();
    });
  }

  createIcons() {
    const icons = {
      attachIcon: document.createElementNS("http://www.w3.org/2000/svg", "svg"),
      removeIcon: document.createElementNS("http://www.w3.org/2000/svg", "svg"),
    };

    icons.attachIcon.setAttribute("viewBox", "0 0 512 512");
    icons.removeIcon.setAttribute("viewBox", "0 0 320 512");

    let pathAttach = document.createElementNS(
      "http://www.w3.org/2000/svg",
      "path"
    );
    let pathRemove = document.createElementNS(
      "http://www.w3.org/2000/svg",
      "path"
    );

    pathAttach.setAttribute(
      "d",
      "M67.508 468.467c-58.005-58.013-58.016-151.92 0-209.943l225.011-225.04c44.643-44.645 117.279-44.645 161.92 0 44.743 44.749 44.753 117.186 0 161.944l-189.465 189.49c-31.41 31.413-82.518 31.412-113.926.001-31.479-31.482-31.49-82.453 0-113.944L311.51 110.491c4.687-4.687 12.286-4.687 16.972 0l16.967 16.971c4.685 4.686 4.685 12.283 0 16.969L184.983 304.917c-12.724 12.724-12.73 33.328 0 46.058 12.696 12.697 33.356 12.699 46.054-.001l189.465-189.489c25.987-25.989 25.994-68.06.001-94.056-25.931-25.934-68.119-25.932-94.049 0l-225.01 225.039c-39.249 39.252-39.258 102.795-.001 142.057 39.285 39.29 102.885 39.287 142.162-.028A739446.174 739446.174 0 0 1 439.497 238.49c4.686-4.687 12.282-4.684 16.969.004l16.967 16.971c4.685 4.686 4.689 12.279.004 16.965a755654.128 755654.128 0 0 0-195.881 195.996c-58.034 58.092-152.004 58.093-210.048.041z"
    );
    pathAttach.setAttribute("fill", "#ffffff");

    pathRemove.setAttribute(
      "d",
      "M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z"
    );
    pathRemove.setAttribute("fill", "#ffffff");

    icons.attachIcon.appendChild(pathAttach);
    icons.removeIcon.appendChild(pathRemove);

    return icons;
  }

  update() {
    if (this.element.files.length > 0) {
      for (let i = 0; i < this.element.files.length; i++) {
        const file = this.element.files[i];
        let parts = file.name.split(".");

        if (
          !this.options.disallowTypes.find(
            (element) => element == parts[parts.length - 1]
          )
        ) {
          this.uploads.items.add(file);
        } else {
          this.error(
            `Ой! Вы не можете загрузить ${parts[parts.length - 1]} файлов.`
          );
        }
      }
    }

    this.calcTotalSize();

    return this;
  }

  calcTotalSize() {
    this.totalSize = 0;

    for (let i = 0; i < this.uploads.files.length; i++) {
      const file = this.uploads.files[i];
      this.totalSize += file.size;
    }
  }

  checkFilesNumber() {
    if (this.uploads.files.length > this.options.maxFilesNumber) {
      this.error(
        `Ой! Вы не можете загрузить больше ${this.options.maxFilesNumber} изображений за раз.`
      );
      let num = this.uploads.files.length;
      for (let i = this.options.maxFilesNumber; i < num; i++) {
        this.removeFileFromFileList(this.options.maxFilesNumber);
      }
    }

    this.calcTotalSize();

    return this;
  }

  checkTotalSize() {
    if (this.totalSize > this.options.maxTotalUploadSize) {
      this.error(`Ой! Вы не можете загрузить больше 10Мб за один раз.`);
      this.totalSize = 0;

      const dt = new DataTransfer();
      let size = 0;

      for (let i = 0; i < this.uploads.files.length; i++) {
        const file = this.element.files[i];
        size += file.size;

        if (size <= this.options.maxTotalUploadSize) {
          dt.items.add(file);
        }
      }

      this.uploads = dt;
    }

    this.calcTotalSize();

    return this;
  }

  render() {
    while (this.template.label.firstChild) {
      this.template.label.removeChild(this.template.label.firstChild);
    }

    if (this.uploads.files.length > 0) {
      for (let i = 0; i < this.uploads.files.length; i++) {
        const file = this.uploads.files[i];
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = (e) => {
          const icons = this.createIcons();
          let fileLabel = document.createElement("span");
          let preview = new Image();
          preview.src = e.target.result;
          fileLabel.appendChild(preview);

          let fileRemoveButton = document.createElement("button");

          fileRemoveButton.setAttribute("type", "button");
          fileRemoveButton.appendChild(icons.removeIcon);

          fileRemoveButton.addEventListener("click", () => {
            if (confirm("Хотите удалить изображение?")) {
              this.removeFileFromFileList(i);
              this.render();
            }
          });

          fileLabel.appendChild(fileRemoveButton);
          this.template.label.appendChild(fileLabel);
        };
      }

      this.element.files = this.uploads.files;
      this.template.label.classList.add("full");

      let submitButton = document.getElementById("send-images");

      if (!submitButton) {
        submitButton = document.createElement("button");
        submitButton.id = "send-images";
        submitButton.classList.add("btn");
        submitButton.classList.add("btn-primary");
        submitButton.innerHTML = "Отправить";
        this.template.container.appendChild(submitButton);
      }
    } else {
      let submitButton = document.getElementById("send-images");

      if (submitButton) {
        submitButton.remove();
      }

      this.template.label.classList.remove("full");
      this.template.label.innerHTML = `Перетащите сюда изображения или <a href="javascript:void(0)">кликните для загрузки</a>`;
    }
  }

  removeFileFromFileList(index) {
    const dt = new DataTransfer();

    for (let i = 0; i < this.uploads.files.length; i++) {
      const file = this.uploads.files[i];
      if (index !== i) {
        dt.items.add(file);
      }
    }

    this.uploads = dt;

    this.calcTotalSize();
  }

  clear() {
    this.element.value = null;
    const dt = new DataTransfer();
    this.uploads = dt;

    if (this.element.value) {
      this.element.parentNode.replaceChild(
        this.element.cloneNode(true),
        this.element
      );
    }

    return this;
  }

  error(message) {
    let text = document.createTextNode(message);
    this.template.error.appendChild(text);
    this.template.error.classList.add("show");

    setTimeout(() => {
      while (this.template.error.firstChild) {
        this.template.error.removeChild(this.template.error.firstChild);
        this.template.error.classList.remove("show");
      }
    }, 4000);
  }
}

module.exports = Javatta;
