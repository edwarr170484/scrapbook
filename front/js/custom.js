const $ = require("jquery");
const bootstrap = require("bootstrap");

$(document).ready(function () {
  var toastElList = [].slice.call(document.querySelectorAll(".toast"));
  var toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl, option);
  });
});
