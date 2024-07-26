document.getElementById("menu-toggle").addEventListener("click", function () {
  var sidebar = document.getElementById("sidebar");
  var mainContent = document.querySelector("main");
  if (sidebar.classList.contains("active")) {
    sidebar.classList.remove("active");
    mainContent.classList.remove("active");
  } else {
    sidebar.classList.add("active");
    mainContent.classList.add("active");
  }
});
