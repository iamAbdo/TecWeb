<?php
include 'includes/CheckIfLoggedIn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/messages.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Admin Dashboard</title>
</head>

<body>

    <?php
    include 'includes/base.php';

    // Delete message action
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $stmt = mysqli_prepare($conn, "DELETE FROM messages WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'The message has been successfully deleted.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'messages.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while deleting the message.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'messages.php';
                });
            </script>";
        }
        mysqli_stmt_close($stmt);
    }

    // Fetch messages from the database
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'created_at';
    $order_dir = isset($_GET['order_dir']) ? $_GET['order_dir'] : 'DESC';

    $query = "SELECT * FROM messages WHERE name LIKE ? OR email LIKE ? OR message LIKE ? ORDER BY $order_by $order_dir";
    $stmt = mysqli_prepare($conn, $query);
    $search_param = "%$search%";
    mysqli_stmt_bind_param($stmt, 'sss', $search_param, $search_param, $search_param);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
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

            <!-- Page content -->
            <div class="content">
                <h1>Messages</h1>
                <!-- Filters -->
                <form method="GET" class="filters">
                    <input type="text" name="search" placeholder="Search messages..."
                        value="<?php echo htmlspecialchars($search); ?>">
                    <select name="order_by">
                        <option value="created_at" <?php echo $order_by == 'created_at' ? 'selected' : ''; ?>>Time
                        </option>
                        <option value="name" <?php echo $order_by == 'name' ? 'selected' : ''; ?>>Name</option>
                        <option value="email" <?php echo $order_by == 'email' ? 'selected' : ''; ?>>Email</option>
                    </select>
                    <select name="order_dir">
                        <option value="ASC" <?php echo $order_dir == 'ASC' ? 'selected' : ''; ?>>Ascending</option>
                        <option value="DESC" <?php echo $order_dir == 'DESC' ? 'selected' : ''; ?>>Descending</option>
                    </select>
                    <button type="submit">Filter</button>
                </form>

                <!-- Messages table -->
                <table class="messages-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Received At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td><?php echo htmlspecialchars($row['message']); ?></td>
                                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                <td>
                                    <form method="POST" action="messages.php" class="delete-form" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="button" class="delete-btn"><i class="fas fa-trash"></i>
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

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>