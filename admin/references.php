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
    include 'includes/base.php';

    // Handle add reference
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_reference'])) {
        $specialty_id = intval($_POST['specialty_id']);
        $name = htmlspecialchars($_POST['name']);
        $author_or_source = htmlspecialchars($_POST['author_or_source']);
        $description = htmlspecialchars($_POST['description']);
        $read_more_url = htmlspecialchars($_POST['read_more_url']);

        $stmt = mysqli_prepare($conn, "INSERT INTO reference (specialty_id, name, author_or_source, description, read_more_url) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'issss', $specialty_id, $name, $author_or_source, $description, $read_more_url);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Added!',
                    text: 'Reference has been successfully added.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'references.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while adding the reference.',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
        mysqli_stmt_close($stmt);
    }

    // Handle delete reference
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_reference']) ) {
        $id = intval($_POST['id']);
        $stmt = mysqli_prepare($conn, "DELETE FROM reference WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Reference has been successfully deleted.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'references.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while deleting the reference.',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
        mysqli_stmt_close($stmt);
    }

    // Fetch specialties for dropdown
    $specialties = mysqli_query($conn, "SELECT id, name FROM specialties");

    // Fetch references
    $query = "SELECT r.id, r.name, r.author_or_source, r.description, r.read_more_url, s.name AS specialty_name 
              FROM reference r 
              JOIN specialties s ON r.specialty_id = s.id";
    $references = mysqli_query($conn, $query);
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
                <h1>References</h1>

                <div class="mb-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReferenceModal">
                        <i class="fas fa-plus"></i> Add Reference
                    </button>
                </div>

                <!-- References Table -->
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Specialty</th>
                            <th>Name</th>
                            <th>Author/Source</th>
                            <th>Description</th>
                            <th>Read More</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($reference = mysqli_fetch_assoc($references)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($reference['specialty_name']); ?></td>
                                <td><?php echo htmlspecialchars($reference['name']); ?></td>
                                <td><?php echo htmlspecialchars($reference['author_or_source']); ?></td>
                                <td><?php echo htmlspecialchars($reference['description']); ?></td>
                                <td>
                                    <?php if (!empty($reference['read_more_url'])): ?>
                                        <a href="<?php echo htmlspecialchars($reference['read_more_url']); ?>" target="_blank"
                                            class="btn btn-link btn-sm">Read More</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="POST" class="delete-form d-inline">
                                        <input type="hidden" name="id" value="<?php echo $reference['id']; ?>">
                                        <button type="submit" name="delete_reference" class="btn btn-danger btn-sm">
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

    <!-- Add Reference Modal -->
    <div class="modal fade" id="addReferenceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Reference</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="specialty_id" class="form-label">Specialty</label>
                            <select name="specialty_id" class="form-select" required>
                                <option value="">Select a specialty</option>
                                <?php while ($specialty = mysqli_fetch_assoc($specialties)): ?>
                                    <option value="<?php echo $specialty['id']; ?>">
                                        <?php echo htmlspecialchars($specialty['name']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Reference Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="author_or_source" class="form-label">Author or Source</label>
                            <input type="text" name="author_or_source" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="read_more_url" class="form-label">Read More URL</label>
                            <input type="url" name="read_more_url" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_reference" class="btn btn-primary">Add Reference</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

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

</body>

</html>