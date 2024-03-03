document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("sidebar");
  const openButton = document.getElementById("openSidebarButton");
  const closeButton = document.getElementById("closeSidebarButton");

  openButton.addEventListener("click", () => {
    sidebar.classList.remove("-translate-x-72");
  });

  closeButton.addEventListener("click", () => {
    sidebar.classList.add("-translate-x-72");
  });
});
