document.querySelectorAll(".menu-toggle").forEach(menu => {

    menu.addEventListener("click", function (e) {

        e.preventDefault();

        const parent = this.parentElement;

        const submenu = parent.querySelector(".submenu");

        parent.classList.toggle("open");

        submenu.classList.toggle("show");

    });

});