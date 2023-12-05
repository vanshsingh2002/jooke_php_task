function validateForm() {
    var email = document.forms["signupForm"]["uname"].value;
    var password = document.forms["signupForm"]["password"].value;
    var rePassword = document.forms["signupForm"]["re_password"].value;

    // Email validation
    if (email === "") {
        alert("Email is required");
        return false;
    } else if (!isValidEmail(email)) {
        alert("Invalid email address");
        return false;
    }

    // Password validation
    if (password === "" || rePassword === "") {
        alert("Password is required");
        return false;
    } else if (password !== rePassword) {
        alert("Passwords do not match");
        return false;
    }

    // Additional validation can be added as needed

    return true;
}

function isValidEmail(email) {
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailRegex.test(email);
}

