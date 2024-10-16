const changePasswordBtn = document.querySelector(".changePasswordBtn");

changePasswordBtn.onclick = function () {
  const passwordInput = document.querySelector("#password");
  passwordInput.disabled = false;
  passwordInput.focus();
};
