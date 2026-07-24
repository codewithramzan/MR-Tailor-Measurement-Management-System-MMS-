
const menu = document.getElementById("menu-toggle");
const sidebar = document.getElementById("sidebar");

if (menu && sidebar) {
    menu.addEventListener("click", () => {

        sidebar.classList.toggle("active");

    });

}
document.addEventListener("DOMContentLoaded", function () {

    const flash = document.getElementById("flash-message");

    if (!flash) return;

    setTimeout(() => {

        flash.classList.remove("show");

        setTimeout(() => {

            flash.remove();

        }, 300);

    }, 3000);

});