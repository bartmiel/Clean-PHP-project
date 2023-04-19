function addDistance(distance, limit) {
  var newDistance = document.createElement("input");
  newDistance.setAttribute("type", "text");
  newDistance.setAttribute("name", "competitionDistance[]");
  newDistance.className = "form-control mt-3";
  var newLimit = document.createElement("input");
  newLimit.setAttribute("type", "number");
  newLimit.setAttribute("name", "competitionDistanceLimit[]");
  newLimit.className = "form-control mt-3";
  var newinputDistance = document.getElementById(distance);
  var newinputLimit = document.getElementById(limit);
  newinputDistance.appendChild(newDistance);
  newinputLimit.appendChild(newLimit);
}

function validateCompetitionForm() {
  const competitionName = document.form.competitionName.value;
  const competitionLocation = document.form.competitionLocation.value;
  const competitionDate = document.form.competitionDate.value;
  const competitionStartHour = document.form.competitionStartHour.value;

  let isFormValid = false;

  const isValidCompetitionName = isInputEmpty(
    "inputCompetitionName",
    competitionName,
    "competitionNameFeedback"
  );
  const isValidCompetitionLocation = isInputEmpty(
    "inputCompetitionLocation",
    competitionLocation,
    "competitionLocationFeedback"
  );
  const isValidCompetitionDate = isInputEmpty(
    "inputCompetitionDate",
    competitionDate,
    "competitionDateFeedback"
  );
  const isValidCompetitionStartHour = isInputEmpty(
    "inputCompetitionStartHour",
    competitionStartHour,
    "competitionStartHourFeedback"
  );

  if (
    isValidCompetitionName &&
    isValidCompetitionLocation &&
    isValidCompetitionDate &&
    isValidCompetitionStartHour
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
