
const menu = document.getElementById("menu-toggle");
const sidebar = document.getElementById("sidebar");

if (menu && sidebar) {
    menu.addEventListener("click", () => {

        sidebar.classList.toggle("active");

    });

}
document.addEventListener("DOMContentLoaded", () => {

    const flash = document.getElementById("flash-message");

    if (!flash) return;

    setTimeout(() => {

        const bsAlert = bootstrap.Alert.getOrCreateInstance(flash);

        bsAlert.close();

    }, 3000);

});