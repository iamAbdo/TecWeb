<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php
    // Start session
    session_start();

    // Include database connection
    include 'includes/base.php';

    // Handle login form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query to check if the email exists in the database
        $query = "SELECT * FROM admins WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

            
        if (mysqli_num_rows($result) > 0) {
            $admin = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $admin['password'])) {
                // Correct login, create session
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_email'] = $admin['email'];

                // Redirect to the dashboard
                header("Location: index.php");
                exit();
            } else {
                $error_message = "Incorrect password.";
            }
        } else {
            $error_message = "Admin with this email doesn't exist.";
        }
    }

    // If there was an error, show it in SweetAlert
    ?>

    <div class="container mt-5">
        <h2>Admin Login</h2>

        <!-- Display SweetAlert if there's an error -->
        <?php if (isset($error_message)): ?>
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: "<?php echo $error_message; ?>",
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>