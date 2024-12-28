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

    // Add Module Logic
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_module'])) {
        $specialty_id = intval($_POST['specialty_id']);
        $name = $conn->real_escape_string($_POST['name']);

        $query = "INSERT INTO modules (specialty_id, name) VALUES (?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("is", $specialty_id, $name);
            if ($stmt->execute()) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Module added successfully!',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = 'modules.php';
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error adding module',
                        text: '" . htmlspecialchars($stmt->error) . "',
                        confirmButtonText: 'OK'
                    });
                </script>";
            }
            $stmt->close();
        }
    }

    // Delete Module Logic
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_module'])) {
        $id = intval($_POST['id']);

        $query = "DELETE FROM modules WHERE id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Module deleted successfully!',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = 'modules.php';
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error deleting module',
                        text: '" . htmlspecialchars($stmt->error) . "',
                        confirmButtonText: 'OK'
                    });
                </script>";
            }
            $stmt->close();
        }
    }

    // Fetch modules with their specialties
    $query = "SELECT modules.id, modules.name, specialties.name AS specialty_name 
              FROM modules 
              JOIN specialties ON modules.specialty_id = specialties.id 
              ORDER BY specialties.name, modules.name";
    $result = $conn->query($query);

    // Fetch specialties for the dropdown
    $specialties_query = "SELECT id, name FROM specialties ORDER BY name";
    $specialties_result = $conn->query($specialties_query);
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
                <h1>Modules</h1>

                <div class="mb-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModuleModal">
                        <i class="fas fa-plus"></i> Add Module
                    </button>
                </div>

                <table class="table table-striped table-bordered modules-table">
                    <thead>
                        <tr>
                            <th>Module Name</th>
                            <th>Specialty</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['specialty_name']); ?></td>
                                <td>
                                    <form method="POST" class="delete-form d-inline">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_module"
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

    <!-- Add Module Modal -->
    <div class="modal fade" id="addModuleModal" tabindex="-1" aria-labelledby="addModuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModuleModalLabel">Add Module</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="module-name" class="form-label">Module Name</label>
                            <input type="text" name="name" id="module-name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="specialty-id" class="form-label">Specialty</label>
                            <select name="specialty_id" id="specialty-id" class="form-select" required>
                                <option value="">Select Specialty</option>
                                <?php while ($specialty = $specialties_result->fetch_assoc()): ?>
                                    <option value="<?= $specialty['id'] ?>"><?= htmlspecialchars($specialty['name']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_module" class="btn btn-primary">Add Module</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                var form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function (result) {
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