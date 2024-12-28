<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Admin Dashboard</title>
</head>

<body>

    <?php
    include 'includes/base.php';

    // Add new admin functionality
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_admin'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt the password
    
        // Insert the new admin into the database
        $insert_query = "INSERT INTO admins (username, password, email) VALUES ('$username', '$password', '$email')";
        if (mysqli_query($conn, $insert_query)) {
            $success_message = "Admin added successfully!";
        } else {
            $error_message = "Error adding admin: " . mysqli_error($conn);
        }
    }

    // Handle delete admin functionality
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_admin'])) {
        $admin_id = $_POST['admin_id'];

        // Delete the admin from the database
        $delete_query = "DELETE FROM admins WHERE id = '$admin_id'";
        if (mysqli_query($conn, $delete_query)) {
            $success_message = "Admin deleted successfully!";
        } else {
            $error_message = "Error deleting admin: " . mysqli_error($conn);
        }
    }

    // Fetch all admins
    $admins_query = "SELECT * FROM admins";
    $admins_result = mysqli_query($conn, $admins_query);
    ?>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <h2>Admin</h2>
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="index.php"><i class="fas fa-tachometer-alt icon"></i> Dashboard</a></li>
                    <li><a href="messages.php"><i class="fas fa-envelope icon"></i> Messages</a></li>
                    <li><a href="students.php"><i class="fas fa-user-graduate icon"></i> Students</a></li>
                    <li><a href="specialties.php"><i class="fas fa-graduation-cap icon"></i> Specialties</a></li>
                    <li><a href="settings.php"><i class="fas fa-cog icon"></i> Settings</a></li>
                    <li><a href="modules.php"><i class="fas fa-book icon"></i> Modules</a></li>
                    <li><a href="certificates.php"><i class="fas fa-certificate icon"></i> Certificates</a></li>
                    <li><a href="references.php"><i class="fas fa-bookmark icon"></i> References</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="main-content">
            <!-- Top navbar -->
            <header class="top-navbar">
                <div class="user-info">
                    <span>Welcome, Admin</span>
                    <form action="logout.php" method="POST">
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>

                </div>
            </header>

            <div class="container mt-5">
                <h1>Admin Management</h1>

                <?php if (isset($success_message)): ?>
                    <script>
                        Swal.fire({
                            title: 'Success!',
                            text: '<?php echo $success_message; ?>',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                <?php elseif (isset($error_message)): ?>
                    <script>
                        Swal.fire({
                            title: 'Error!',
                            text: '<?php echo $error_message; ?>',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    </script>
                <?php endif; ?>

                <!-- Add Admin Form Button -->
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                    <i class="fas fa-plus"></i> Add Admin
                </button>

                <!-- Admins Table -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($admin = mysqli_fetch_assoc($admins_result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($admin['username']); ?></td>
                                <td><?php echo htmlspecialchars($admin['email']); ?></td>
                                <td><?php echo htmlspecialchars($admin['created_at']); ?></td>
                                <td>
                                    <!-- Delete Admin Button -->
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="admin_id" value="<?php echo $admin['id']; ?>">
                                        <button type="submit" name="delete_admin" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Admin Modal -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAdminModalLabel">Add Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="admin-username" class="form-label">Username</label>
                            <input type="text" name="username" id="admin-username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="admin-email" class="form-label">Email</label>
                            <input type="email" name="email" id="admin-email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="admin-password" class="form-label">Password</label>
                            <input type="password" name="password" id="admin-password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_admin" class="btn btn-primary">Add Admin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap and SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>