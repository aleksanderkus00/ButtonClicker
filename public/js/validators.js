const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const okButton = document.getElementById("OkButton");

function isEmail(email) {
  let result = /\S+@\S+\.\S+/.test(email);
  result ? enableButton() : disableButton();
  return result;
}

function isPasswordLenGood(password) {
  let result = password.length > 8;
  result ? enableButton() : disableButton();
  return result;
}

function markValidation(element, condition) {
  !condition
    ? element.classList.add("no-valid")
    : element.classList.remove("no-valid");
}

function validateEmail() {
  setTimeout(() => {
    markValidation(emailInput, isEmail(emailInput.value));
  }, 1000);
}

function validatePassword() {
  setTimeout(() => {
    markValidation(passwordInput, isPasswordLenGood(passwordInput.value));
  }, 1000);
}

function disableButton() {
  okButton.disabled = true;
}

function enableButton() {
  okButton.disabled = false;
}

emailInput.addEventListener("keyup", validateEmail);
passwordInput.addEventListener("keyup", validatePassword);
