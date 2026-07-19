
const menu = document.getElementById("menu-toggle");
const sidebar = document.getElementById("sidebar");

if (menu && sidebar) {

    menu.addEventListener("click", () => {

        sidebar.classList.toggle("active");

    });

}
document.addEventListener("DOMContentLoaded", function () {
   
    const flash = document.querySelector(".alert");

    if (flash) {

        setTimeout(function () {

            flash.classList.remove("show");

            flash.classList.add("fade");

            setTimeout(function () {

                flash.remove();

            }, 300);

        }, 3000);

    }

});