<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/messages.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Admin Dashboard</title>
</head>

<body>

    <?php
    include 'includes/base.php';


    // Add Specialty Logic
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_specialty'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $specialty_type = $conn->real_escape_string($_POST['specialty_type']);
        $description = $conn->real_escape_string($_POST['description']);

        $query = "INSERT INTO specialties (name, specialty_type, description) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $specialty_type, $description);

        if ($stmt->execute()) {
            echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Specialty added successfully!',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'specialties.php';
        });
        </script>";
        } else {
            echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error adding specialty',
            text: '" . htmlspecialchars($stmt->error) . "',
            confirmButtonText: 'OK'
        });
        </script>";
        }
        $stmt->close();
    }

    // Delete Specialty Logic
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_specialty'])) {
        $id = intval($_POST['id']);

        $query = "DELETE FROM specialties WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Specialty deleted successfully!',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'specialties.php';
        });
        </script>";
        } else {
            echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error deleting specialty',
            text: '" . htmlspecialchars($stmt->error) . "',
            confirmButtonText: 'OK'
        });
        </script>";
        }
        $stmt->close();
    }

    // Fetch specialties
    $query = "SELECT * FROM specialties ORDER BY created_at DESC";
    $result = $conn->query($query);
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
                    <li><a href="partners.php"><i class="fas fa-handshake icon"></i> Partners</a></li>
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
                <h1>Specialties</h1>

                <div class="mb-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSpecialtyModal">
                        <i class="fas fa-plus"></i> Add Specialty
                    </button>
                </div>

                <table class="table table-striped table-bordered specialties-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['specialty_type']) ?></td>
                                <td><?= htmlspecialchars($row['description']) ?></td> <!-- Display description -->
                                <td><?= htmlspecialchars($row['created_at']) ?></td>
                                <td>
                                    <form method="POST" class="delete-form d-inline">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="delete_specialty"
                                            class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Specialty Modal -->
    <div class="modal fade" id="addSpecialtyModal" tabindex="-1" aria-labelledby="addSpecialtyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSpecialtyModalLabel">Add Specialty</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="specialty-name" class="form-label">Name</label>
                            <input type="text" name="name" id="specialty-name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="specialty-type" class="form-label">Type</label>
                            <select name="specialty_type" id="specialty-type" class="form-select" required>
                                <option value="License">License</option>
                                <option value="Masters">Masters</option>
                                <option value="PhD">PhD</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="specialty-description" class="form-label">Description</label>
                            <textarea name="description" id="specialty-description" class="form-control" rows="3"
                                required></textarea> <!-- New description field -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_specialty" class="btn btn-primary">Add Specialty</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>