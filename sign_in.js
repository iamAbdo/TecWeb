// Select the required elements
const logInPage = document.querySelector('.logIn'); 
const signUpPage = document.querySelector('#SignUp'); 
const toSignUpLink = document.querySelector('.signup-link a'); 
const toLogInLink = signUpPage.querySelector('.signup-link a'); 
const togglePassword = document.querySelector("#togglePassword");
const passwordInput = document.querySelector("#password");
const togglePassword1 = document.querySelector("#togglePassword1");
const passwordInput1 = document.querySelector("#password1");
const togglePassword2 = document.querySelector("#togglePassword2");
const passwordInput2 = document.querySelector("#password2");
const signUpForm = document.querySelector('#SignUp form');
const password1 = document.querySelector("#password1");
const password2 = document.querySelector("#password2");


signUpForm.addEventListener('submit', (event) => {
    if (password1.value !== password2.value) {
        event.preventDefault();
        showCustomAlert("Passwords do not match. Please try again.");
    }
});

function showCustomAlert(message) {
    // Create the alert overlay
    const alertOverlay = document.createElement('div');
    alertOverlay.style.position = 'fixed';
    alertOverlay.style.top = '0';
    alertOverlay.style.left = '0';
    alertOverlay.style.width = '100%';
    alertOverlay.style.height = '100%';
    alertOverlay.style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
    alertOverlay.style.display = 'flex';
    alertOverlay.style.justifyContent = 'center';
    alertOverlay.style.alignItems = 'flex-start'; // Align items at the top
    alertOverlay.style.zIndex = '1000';
    

    // Create the alert box
    const alertBox = document.createElement('div');
    alertBox.style.backgroundColor = 'white';
    alertBox.style.padding = '20px 40px';
    alertBox.style.borderRadius = '10px';
    alertBox.style.textAlign = 'center';
    alertBox.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
    alertBox.style.fontSize = '20px';
    alertBox.style.color = '#333';
    alertBox.style.maxWidth = '500px';
    alertBox.style.width = '80%';
    alertBox.innerText = message;

    // Create the close button
    const closeButton = document.createElement('button');
    closeButton.innerText = 'OK';
    closeButton.style.marginTop = '20px';
    closeButton.style.padding = '10px 20px';
    closeButton.style.backgroundColor = '#7d2ae8';
    closeButton.style.border = 'none';
    closeButton.style.color = 'white';
    closeButton.style.fontSize = '16px';
    closeButton.style.borderRadius = '5px';
    closeButton.style.cursor = 'pointer';
    closeButton.addEventListener('click', () => {
        document.body.removeChild(alertOverlay); // Remove the alert overlay
    });

    // Append elements
    alertBox.appendChild(closeButton);
    alertOverlay.appendChild(alertBox);
    document.body.appendChild(alertOverlay);
}

// Function to show the Sign Up page
toSignUpLink.addEventListener('click', (event) => {
    event.preventDefault(); 
    logInPage.style.display = 'none'; 
    signUpPage.style.display = 'flex'; 
});

// Function to show the Log In page
toLogInLink.addEventListener('click', (event) => {
    event.preventDefault(); 
    signUpPage.style.display = 'none'; 
    logInPage.style.display = 'flex'; 
});

togglePassword.addEventListener("click", () => {
    // Toggle the type attribute
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);

    // Toggle the icon
    togglePassword.classList.toggle("uil-eye");
    togglePassword.classList.toggle("uil-eye-slash");
});

togglePassword1.addEventListener("click", () => {
    // Toggle the type attribute
    const type = passwordInput1.getAttribute("type") === "password" ? "text" : "password";
    passwordInput1.setAttribute("type", type);

    // Toggle the icon
    togglePassword1.classList.toggle("uil-eye");
    togglePassword1.classList.toggle("uil-eye-slash");
});

togglePassword2.addEventListener("click", () => {
    // Toggle the type attribute
    const type = passwordInput2.getAttribute("type") === "password" ? "text" : "password";
    passwordInput2.setAttribute("type", type);

    // Toggle the icon
    togglePassword2.classList.toggle("uil-eye");
    togglePassword2.classList.toggle("uil-eye-slash");
});
