// Menu Toggle 

const menuBtn = document.getElementById("menu-toggle");
const mobileMenu = document.querySelector(".mobile-nav");

if (menuBtn) {

    menuBtn.addEventListener("click", () => {

        mobileMenu.classList.toggle("mb-menu-show");

    })

}


// Admin Dashboard Sodebar Toggle


const dashToggleBtn = document.getElementById("dash-side-toggle");

const dashSideBar = document.querySelector(".dash-sidebar");
const dashView = document.querySelector(".dash-view");

let scrWidth = screen.width;

if (scrWidth < 993) {
    dashSideBar.classList.add("dash-sidebar-hide");
} else {
    dashSideBar.classList.remove("dash-sidebar-hide");
}

if (dashToggleBtn) {

    dashToggleBtn.addEventListener("click", () => {

        if (dashSideBar.classList.contains("dash-sidebar-hide")) {

            dashSideBar.classList.remove("dash-sidebar-hide");
            dashView.classList.remove("dash-view-active");

        } else {

            dashSideBar.classList.add("dash-sidebar-hide");
            dashView.classList.add("dash-view-active");

        }

    })

}

const dashSideClose = document.getElementById("dash-sidebar-close");

if (dashSideClose) {

    dashSideClose.addEventListener("click", () => {

        dashSideBar.classList.add("dash-sidebar-hide");
    });

}