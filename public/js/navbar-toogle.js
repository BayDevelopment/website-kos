const body = document.body;
const sidebar = document.getElementById("mhsSidebar");
const sidebarToggle = document.getElementById("sidebarToggle");
const sidebarClose = document.getElementById("sidebarClose");
const sidebarOverlay = document.getElementById("sidebarOverlay");
const sidebarDesktopToggle = document.getElementById("sidebarDesktopToggle");

if (sidebarToggle) {
    sidebarToggle.addEventListener("click", function () {
        body.classList.add("sidebar-mobile-open");
    });
}

if (sidebarClose) {
    sidebarClose.addEventListener("click", function () {
        body.classList.remove("sidebar-mobile-open");
    });
}

if (sidebarOverlay) {
    sidebarOverlay.addEventListener("click", function () {
        body.classList.remove("sidebar-mobile-open");
    });
}

if (sidebarDesktopToggle) {
    sidebarDesktopToggle.addEventListener("click", function () {
        body.classList.toggle("sidebar-collapsed");
    });
}
