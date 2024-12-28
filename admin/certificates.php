<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/references.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>References</title>
</head>

<body>

    <?php
    // Include database connection
    include('includes/base.php');

    // Handle form submission for adding a certificate
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_certificate'])) {
        $specialty_id = $_POST['specialty_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Handle image upload
        $image = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

            // Validate image extension
            if (in_array(strtolower($image_ext), $allowed_exts)) {
                // Generate a unique image name
                $image_new_name = uniqid('cert_') . '.' . $image_ext;
                $image_path = 'uploads/certificates/' . $image_new_name;

                // Move the uploaded file to the desired directory
                if (move_uploaded_file($image_tmp, '../' . $image_path)) {
                    $image = $image_path;
                } else {
                    $error = "Error uploading image.";
                }
            } else {
                $error = "Invalid image file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            }
        }

        // Insert the certificate into the database if the image was successfully uploaded
        if (!isset($error)) {
            $query = "INSERT INTO certificates (specialty_id, name, description, image) 
                  VALUES ('$specialty_id', '$name', '$description', '$image')";
            if (mysqli_query($conn, $query)) {
                $success = "Certificate added successfully!";
            } else {
                $error = "Error adding certificate: " . mysqli_error($conn);
            }
        }
    }

    // Handle delete certificate
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_certificate'])) {
        $certificate_id = $_POST['certificate_id'];

        // Fetch the certificate info to get the image path
        $select_query = "SELECT image FROM certificates WHERE id = '$certificate_id'";
        $select_result = mysqli_query($conn, $select_query);
        $certificate = mysqli_fetch_assoc($select_result);

        if ($certificate) {
            $image_path = $certificate['image'];
            // Delete the image file from the server
            if (file_exists('../' . $image_path)) {
                unlink('../' . $image_path); // Remove the image file
            }

            // Delete the certificate record from the database
            $delete_query = "DELETE FROM certificates WHERE id = '$certificate_id'";
            if (mysqli_query($conn, $delete_query)) {
                // Success: Output SweetAlert for successful delete
                echo "<script>
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Certificate has been deleted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location = 'certificates.php'; // Redirect to the certificates page
                    });
                  </script>";
            } else {
                // Error: Output SweetAlert for error in deletion
                echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an error deleting the certificate. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                  </script>";
            }
        } else {
            // Error: Certificate not found
            echo "<script>
                Swal.fire({
                    title: 'Not Found!',
                    text: 'Certificate not found.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
        }
    }


    // Fetch specialties to populate the dropdown
    $specialties_query = "SELECT * FROM specialties";
    $specialties_result = mysqli_query($conn, $specialties_query);

    // Fetch certificates to display in the table
    $certificates_query = "SELECT c.*, s.name AS specialty_name 
                        FROM certificates c 
                        JOIN specialties s ON c.specialty_id = s.id";
    $certificates_result = mysqli_query($conn, $certificates_query);
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
            <header class="top-navbar">
                <div class="user-info">
                    <span>Welcome, Admin</span>
                    <button>Logout</button>
                </div>
            </header>

            <div class="content">
                <h1>Certificates</h1>

                <div class="mb-4">
                    <!-- Add Certificate Button (No functionality for now) -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCertificateModal">
                        <i class="fas fa-plus"></i> Add Certificate
                    </button>
                </div>

                <!-- Certificates Table -->
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Specialty</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($certificate = mysqli_fetch_assoc($certificates_result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($certificate['specialty_name']); ?></td>
                                <td><?php echo htmlspecialchars($certificate['name']); ?></td>
                                <td><?php echo htmlspecialchars($certificate['description']); ?></td>
                                <td>
                                    <img src="../<?php echo htmlspecialchars($certificate['image']); ?>"
                                        alt="Certificate Image" width="100">
                                </td>
                                <td>
                                    <!-- Delete Certificate Button -->
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="certificate_id"
                                            value="<?php echo $certificate['id']; ?>">
                                        <button type="submit" name="delete_certificate" class="btn btn-danger btn-sm">
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

    <!-- Add Certificate Modal -->
    <div class="modal fade" id="addCertificateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Certificate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="specialty_id" class="form-label">Specialty</label>
                            <select name="specialty_id" class="form-select" required>
                                <option value="">Select a specialty</option>
                                <?php while ($specialty = mysqli_fetch_assoc($specialties_result)): ?>
                                    <option value="<?php echo $specialty['id']; ?>">
                                        <?php echo htmlspecialchars($specialty['name']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Certificate Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Certificate Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_certificate" class="btn btn-primary">Add Certificate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>