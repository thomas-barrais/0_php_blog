function toggleInput() {
  var selectElement = document.getElementById("category");
  var additionalInput = document.getElementById("additionalInput");
  var additionalInputField = document.getElementById("additionalInputField");
  var secondAdditionalInput = document.getElementById("secondAdditionalInput");
  var secondAdditionalInputField = document.getElementById("secondAdditionalInputField");

  
  if (selectElement.value === "entreprise") {
    additionalInput.classList.remove("hidden");
    additionalInputField.classList.remove("hidden");
    secondAdditionalInput.classList.add("hidden");
    secondAdditionalInputField.classList.add("hidden");
  } else {
    additionalInput.classList.add("hidden");
    additionalInputField.classList.add("hidden");
    secondAdditionalInput.classList.remove("hidden");
    secondAdditionalInputField.classList.remove("hidden");
  }
}