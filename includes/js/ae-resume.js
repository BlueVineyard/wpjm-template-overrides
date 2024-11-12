document.addEventListener("DOMContentLoaded", function () {
  var showChar = 300; // How many characters are shown by default
  var ellipsestext = "...";
  var moretext = "Read more";
  var lesstext = "Read less";

  if (document.querySelector(".toggle-text")) {
    document.querySelectorAll(".toggle-text").forEach(function (element) {
      var content = element.innerHTML;
      if (content.length > showChar) {
        var contentExcert = content.substr(0, showChar);
        var contentRest = content.substr(showChar, content.length - showChar);
        var html =
          contentExcert +
          '<span class="toggle-text-ellipses">' +
          ellipsestext +
          '</span><span class="toggle-text-content">' +
          contentRest +
          '</span><a href="javascript:;" class="toggle-text-link">' +
          moretext +
          "</a>";
        element.innerHTML = html;
      }
    });
  }

  document.addEventListener("click", function (event) {
    if (event.target.classList.contains("toggle-text-link")) {
      var link = event.target;
      if (link.classList.contains("less")) {
        link.classList.remove("less");
        link.innerHTML = moretext;
      } else {
        link.classList.add("less");
        link.innerHTML = lesstext;
      }
      link.previousElementSibling.toggle();
      link.previousElementSibling.previousElementSibling.toggle();
      return false;
    }
  });
});
