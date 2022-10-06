function showForm() {
  let formLogin = document.getElementById("login-form");
  if (formLogin.classList.contains("active")) {
    formLogin.className = "login-form close";
  } else {
    formLogin.className = "login-form active";
  }
}

function showSubmenu() {
  let submenu = document.getElementById("dropdown-menu");
  let angleDown = document.getElementById("fa-angle-down");
  if (submenu.classList.contains("active")) {
    submenu.className = "dropdown-menu close";
    angleDown.className = "fa fa-angle-down close";
  } else {
    submenu.className = "dropdown-menu active";
    angleDown.className = "fa fa-angle-down active";
  }
}

function showFlashMessage(type) {
  flash = document.getElementById("flash");
  if (flash) {
    if (type === "error") {
      setTimeout(function () {
        flash.className += " active";
        setTimeout(function () {
          flash.className = "modal error";
        }, 3000);
      }, 400);
    } else if (type === "success") {
      setTimeout(function () {
        flash.className += " active";
        setTimeout(function () {
          flash.className = "modal success";
        }, 3000);
      }, 400);
    }
  }
}

/* devloped by achille david and thibaut dusautoir */