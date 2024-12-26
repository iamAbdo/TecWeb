// Function to get the query parameters from the URL
function getUrlParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

const error = getUrlParameter('success');

if (error=='message_sent') {
    let text = 'Your message has been sent successfully!';
    let icon = 'success';

 Swal.fire({
    text: text,
    icon: icon,
    confirmButtonText: 'OK'
});
}
