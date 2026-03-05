document.addEventListener("click", (e) => {
    const toggle = document.getElementById("navToggle");
    const nav = document.querySelector(".nav");
    if (!toggle || !toggle.checked) return;
    if (!nav.contains(e.target)) toggle.checked = false;
});
