// Character Checker 1
const usernameChecker = document.getElementById("username");

usernameChecker.addEventListener('input', function() {
    if (usernameChecker.value.length >= 5) {
        usernameChecker.setAttribute("aria-invalid", "false");
    } else {
        usernameChecker.setAttribute("aria-invalid", "true");
    }
});

// Character Checker 2

const passwordChecker = document.getElementById("password");

passwordChecker.addEventListener('input', function() {
    if (passwordChecker.value.length >= 5) {
        passwordChecker.setAttribute("aria-invalid", "false");
    } else {
        passwordChecker.setAttribute("aria-invalid", "true");
    }
});






// Future plans. checking if names is already used.