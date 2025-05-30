document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (e) {
    clearErrors();

    let hasError = false;

    const name = form.name.value.trim();
    if (name === "" || !/^[A-Za-z\s]+$/.test(name)) {
      showError("nameError", "Name must contain letters only.");
      hasError = true;
    }

    const password = form.password.value;
    if (password.length < 6) {
      showError("passwordError", "Password must be at least 6 characters.");
      hasError = true;
    }

    const number = form.number.value.trim();
    if (number === "" || !/^\d+$/.test(number)) {
      showError("numberError", "Number must contain digits only.");
      hasError = true;
    }

    const clubs = form.querySelectorAll('input[name="clubs[]"]:checked');
    if (clubs.length === 0) {
      showError("clubError", "Please select at least one club.");
      hasError = true;
    }

    const feedback = form.feedback.value.trim().toLowerCase();
    if (feedback !== "yes" && feedback !== "no") {
      showError("feedbackError", 'Feedback must be "yes" or "no".');
      hasError = true;
    }

    if (hasError) {
      e.preventDefault();
    }
  });

  function showError(elementId, message) {
    const el = document.getElementById(elementId);
    if (el) {
      el.textContent = message;
      el.style.color = "red";
    }
  }

  function clearErrors() {
    ["nameError", "passwordError", "numberError", "clubError", "membershipError", "feedbackError"].forEach(id => {
      const el = document.getElementById(id);
      if (el) el.textContent = "";
    });
  }
});


