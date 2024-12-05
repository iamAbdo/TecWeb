// Select the required elements
const logInPage = document.querySelector('.logIn'); 
const signUpPage = document.querySelector('#SignUp'); 
const toSignUpLink = document.querySelector('.signup-link a'); 
const toLogInLink = signUpPage.querySelector('.signup-link a'); 
const togglePassword = document.querySelector("#togglePassword");
const passwordInput = document.querySelector("#password");

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
