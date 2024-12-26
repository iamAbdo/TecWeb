// Function to get the query parameters from the URL
function getUrlParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

// Check if there's an 'erreur' parameter in the URL
const error = getUrlParameter('erreur');

if (error) {
    let title = '';
    let text = '';
    let icon = 'error';

    // Set different messages based on the 'erreur' parameter
    switch (error) {
        case 'empty_fields':
            title = 'Missing Fields';
            text = 'Please enter both email and password.';
            break;
        case 'incorrect_password':
            title = 'Incorrect Password';
            text = 'The password you entered is incorrect. Please try again.';
            break;
        case 'no_account_found':
            title = 'No Account Found';
            text = 'There is no account associated with this email address.';
            break;
        case 'database_error':
            title = 'Error';
            text = 'There was an issue with the database. Please try again later.';
            break;
        case 'account_created':
            title = 'Account Created';
            text = 'Your account has been successfully created! You can now log in.';
            icon = 'success';
            break;
        default:
            title = 'Unknown Error';
            text = 'An unknown error occurred.';
    }

    // Show SweetAlert with the appropriate message
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: 'OK'
    });
}
