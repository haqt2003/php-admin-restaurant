const userToggle = document.querySelector(".header_user");
const userToggleList = document.querySelector(".header_user-dropdown");

userToggle.onclick = function () {
  userToggleList.classList.toggle("visually-hidden");
};
