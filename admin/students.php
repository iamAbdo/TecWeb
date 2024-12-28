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

// Replace null coalescing operator with isset()
$search = isset($_GET['search']) ? $_GET['search'] : '';
$specialty_filter = isset($_GET['specialty_id']) ? $_GET['specialty_id'] : '';

// Fetch specialties for the filter
$specialty_query = "SELECT id, name FROM specialties";
$specialties_result = $conn->query($specialty_query);

if (!$specialties_result) {
    die("Error fetching specialties: " . $conn->error);
}

// Base query
$query = "SELECT students.*, specialties.name AS specialty_name 
          FROM students 
          LEFT JOIN specialties ON students.specialty_id = specialties.id";
$conditions = [];
$params = [];
$types = '';

// Filters
if (!empty($search)) {
    $conditions[] = "(students.name LIKE ? OR students.email LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types .= 'ss';
}

if (!empty($specialty_filter)) {
    $conditions[] = "students.specialty_id = ?";
    $params[] = $specialty_filter;
    $types .= 'i';
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(' AND ', $conditions);
}

$query .= " ORDER BY students.created_at DESC";

// Prepare the SQL statement
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Error preparing query: " . $conn->error . "\nQuery: " . $query);
}

// Bind parameters for older PHP versions
if (!empty($params)) {
    $args = array_merge([$types], $params);
    $bind_result = call_user_func_array([$stmt, 'bind_param'], refValues($args));
    if (!$bind_result) {
        die("Error binding parameters: " . $stmt->error);
    }
}

// Execute the statement
if (!$stmt->execute()) {
    die("Error executing query: " . $stmt->error);
}

// Fetch the result
$result = $stmt->get_result();
if (!$result) {
    die("Error fetching result: " . $stmt->error);
}

/**
 * Helper function to pass arguments by reference for call_user_func_array.
 */
function refValues($arr) {
    $refs = [];
    foreach ($arr as $key => $value) {
        $refs[$key] = &$arr[$key];
    }
    return $refs;
}
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
            <!-- Top navbar -->
            <header class="top-navbar">
                <div class="user-info">
                    <span>Welcome, Admin</span>
                    <button>Logout</button>
                </div>
            </header>

            <!-- Page content -->
            <div class="content">
                <h1>Students</h1>

                <div class="filters mb-4">
                    <form method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="Search students..."
                            value="<?= htmlspecialchars($search) ?>">
                        <select name="specialty_id" class="form-select">
                            <option value="">All Specialties</option>
                            <?php while ($specialty = $specialties_result->fetch_assoc()): ?>
                                <option value="<?= $specialty['id'] ?>" <?= $specialty_filter == $specialty['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($specialty['name']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>

                <table class="table table-striped table-bordered students-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Specialty</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['specialty_name']) ?></td>
                                <td><?= htmlspecialchars($row['created_at']) ?></td>
                                <td>
                                    <form method="POST" action="delete_student.php" class="delete-form d-inline">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="button" class="btn btn-danger btn-sm delete-btn"><i
                                                class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
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
</body>

</html>