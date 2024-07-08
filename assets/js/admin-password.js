//  Show Password Login

$("#yourAdminPassword").on("keyup", function () {
  var input = $(this).val();
  let element = document.getElementById("adminicon");
  element.hidden = input === "";
});

document
  .querySelector(".toggle-admin-password")
  .addEventListener("click", function (e) {
    const password = document.querySelector("#yourAdminPassword");
    const type =
      password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    this.classList.toggle("bi-eye-slash-fill");
  });
