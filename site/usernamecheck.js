// Character Checker 1
const usernameChecker = document.getElementById("username");

usernameChecker.addEventListener('input', function() {
    if (usernameChecker.value.length >= 6) {
        usernameChecker.setAttribute("aria-invalid", "false");
    } else {
        usernameChecker.setAttribute("aria-invalid", "true");
    }
});

// Character Checker 2

const passwordChecker = document.getElementById("password");

passwordChecker.addEventListener('input', function() {
    if (passwordChecker.value.length >= 6) {
        passwordChecker.setAttribute("aria-invalid", "false");
    } else {
        passwordChecker.setAttribute("aria-invalid", "true");
    }
});

// Popup sign up window


// Future plans. checking if names is already used.