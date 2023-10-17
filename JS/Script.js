/*
    Created by: Hussein Mansour
    Created on: 2023/07/22
    Course/Section: CST8285/300
*/

// Sign-up Validation
function validate() {
    // Get the form inputs by their IDs

    // Get email and emailError (email).
    const email = document.getElementById('email').value;
    const emailError = document.getElementById('emailError');
    const emailPattern = /\S+@\S+\.\S+/;

    // Get login and loginError (username).
    const login = document.getElementById('login').value.toLowerCase();
    const loginError = document.getElementById('loginError');

    // Get pass pass2 and passwordError (passowrd).
    const pass = document.getElementById('pass').value;
    const pass2 = document.getElementById('pass2').value;
    const passwordError = document.getElementById('passwordError');
    const passwordError2 = document.getElementById('passwordError2');
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z]).{6,}$/;

    // variable to keep track if data is valid
    let isValid = true;

    // Check if the email address is valid using a simple pattern check
    if (!email.match(emailPattern)) {
        emailError.style.display = 'block'; // show the error
        isValid = false; // Prevent form submission
    } else {
        emailError.style.display = 'none'; // hide the error
    }

    // Check if the username is not empty
    if (login === '' || login.length >= 20) {
        loginError.style.display = 'block'; // show the error
        isValid = false; // Prevent form submission
    } else {
        loginError.style.display = 'none'; // hide the error
    }

    // Check password length, uppercase, and lowercase letters
    if (!pass.match(passwordPattern)) {
        passwordError.style.display = 'block'; // show the error
        isValid = false;
    } else {
        passwordError.style.display = 'none'; // hide the error
    }

    // Check retyped password 
    if (pass !== pass2 || pass === '') {
        passwordError2.style.display = 'block'; // show the error
        isValid = false;
    } else {
        passwordError2.style.display = 'none'; // hide the error
    }

    // If all validation checks pass, allow the form submission
    return isValid;
}

// Show password
const showPasswordCheckbox = document.getElementById("showPassword");
const passwordInput = document.getElementById("password");
const passwordInput2 = document.getElementById("pass2");

showPasswordCheckbox.addEventListener("change", function () {
    if (showPasswordCheckbox.checked) {
        passwordInput.type = "text";
        passwordInput2.type = "text";
    } else {
        passwordInput.type = "password";
        passwordInput2.type = "password";
    }
});

//to-do-list add task
function addTask() {
    const inputBox = document.getElementById("input-box");
    const listContainer = document.getElementById("list-container");

    if (inputBox.value === '') {
        alert("You must type something!");
    } else {
        let li = document.createElement("li");
        li.innerHTML = inputBox.value;
        li.addEventListener("click", toggleTaskStatus);
        listContainer.appendChild(li);
        
        let x = document.createElement("span");
        x.innerHTML = "\u00d7"; 
        x.classList.add("remove-button"); 
        x.addEventListener("click", removeTask);
        li.appendChild(x);
    }

    inputBox.value = "";
}
// to-do-list task status (present-remove)
function toggleTaskStatus() {
    this.classList.toggle("checked");
    
}
// to-do-list task status (present-remove)
function removeTask(event) {
    if (event.target.tagName === "SPAN") {
        event.target.parentElement.remove();
    }
}