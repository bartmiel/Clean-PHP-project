function hideClub() {
  document.getElementById("clubData").style.display = "none";
}

function showClub() {
  document.getElementById("clubData").style.display = "block";
}

function validateForm() {
  const firstname = document.form.firstname.value;
  const lastname = document.form.lastname.value;
  const street = document.form.street.value;
  const city = document.form.city.value;
  const postalCode = document.form.postalCode.value;
  const email = document.form.email.value;
  const password = document.form.password.value;
  const confirmPassword = document.form.confirmPassword.value;

  let isFormValid = false;

  const isValidFirstName = isInputEmpty(
    "inputFirstName",
    firstname,
    "firstNameFeedback"
  );
  const isValidLastName = isInputEmpty(
    "inputLastName",
    lastname,
    "lastNameFeedback"
  );
  const isValidStreet = isInputEmpty("inputStreet", street, "streetFeedback");
  const isValidCity = isInputEmpty("inputCity", city, "cityFeedback");
  const isValidPostal = isPostalCodeValid(
    "inputPostal",
    postalCode,
    "postalFeedback"
  );
  const isValidEmail = isInputEmpty("inputEmail", email, "emailFeedback");
  const isValidPassword = isPasswordValid(
    "inputPassword",
    "inputConfirmPassword",
    password,
    confirmPassword,
    "password"
  );

  if (
    isValidFirstName &&
    isValidLastName &&
    isValidStreet &&
    isValidCity &&
    isValidPostal &&
    isValidEmail &&
    isValidPassword
  ) {
    isFormValid = true;
  }
  return isFormValid;
}

function isInputEmpty(inputId, inputValue, feedbackId) {
  if (inputValue.trim() === "") {
    document.getElementById(`${inputId}`).classList.add("is-invalid");
    document.getElementById(`${feedbackId}`).innerHTML =
      "To pole nie może być puste.";
    return false;
  }
  document.getElementById(`${inputId}`).classList.remove("is-invalid");
  return true;
}

function isPostalCodeValid(inputId, inputValue, feedbackId) {
  if (inputValue.trim().length !== 6) {
    document.getElementById(`${inputId}`).classList.add("is-invalid");
    document.getElementById(`${feedbackId}`).innerHTML =
      "Np. 12-456 (6 znaków).";
    return false;
  }
  document.getElementById(`${inputId}`).classList.remove("is-invalid");
  return true;
}

function isPasswordValid(
  inputId1,
  inputId2,
  enteredPassword,
  enteredConfirmPassword,
  feedbackId
) {
  if (enteredPassword.trim().length < 6) {
    document.getElementById(`${inputId1}`).classList.add("is-invalid");
    document.getElementById(`${feedbackId}`).innerHTML =
      "Minimalna długość hasła to 6 znaków.";
    return false;
  }
  if (enteredPassword !== enteredConfirmPassword) {
    document.getElementById(`${inputId1}`).classList.add("is-invalid");
    document.getElementById(`${inputId2}`).classList.add("is-invalid");
    document.getElementById(`${feedbackId}`).innerHTML =
      "Hasła muszą być takie same.";
    return false;
  }
  document.getElementById(`${inputId1}`).classList.remove("is-invalid");
  document.getElementById(`${inputId2}`).classList.remove("is-invalid");
  return true;
}
