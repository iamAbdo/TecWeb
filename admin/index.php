<?php
include 'includes/CheckIfLoggedIn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- For charts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <title>Admin Dashboard</title>
</head>

<body>

    <?php
    include('includes/base.php');


    $total_students_query = "SELECT COUNT(*) AS total FROM students";
    $total_specialties_query = "SELECT COUNT(*) AS total FROM specialties";
    $total_messages_query = "SELECT COUNT(*) AS total FROM messages";
    $total_certificates_query = "SELECT COUNT(*) AS total FROM certificates";


    $total_students_result = mysqli_query($conn, $total_students_query);
    $total_specialties_result = mysqli_query($conn, $total_specialties_query);
    $total_messages_result = mysqli_query($conn, $total_messages_query);
    $total_certificates_result = mysqli_query($conn, $total_certificates_query);


    $total_students = mysqli_fetch_assoc($total_students_result)['total'];
    $total_specialties = mysqli_fetch_assoc($total_specialties_result)['total'];
    $total_messages = mysqli_fetch_assoc($total_messages_result)['total'];
    $total_certificates = mysqli_fetch_assoc($total_certificates_result)['total'];


    $students_per_month_query = "SELECT MONTH(created_at) AS month, COUNT(*) AS total FROM students GROUP BY MONTH(created_at)";
    $students_per_month_result = mysqli_query($conn, $students_per_month_query);

    $months = [];
    $student_counts = [];
    while ($row = mysqli_fetch_assoc($students_per_month_result)) {
        $months[] = $row['month'];
        $student_counts[] = $row['total'];
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

            <!-- Dashboard widgets -->
            <section class="dashboard-widgets">
                <div class="widget">
                    <h3>Total Students</h3>
                    <p><?php echo number_format($total_students); ?></p>
                </div>
                <div class="widget">
                    <h3>Total Specialties</h3>
                    <p><?php echo number_format($total_specialties); ?></p>
                </div>
                <div class="widget">
                    <h3>Total Messages</h3>
                    <p><?php echo number_format($total_messages); ?></p>
                </div>
                <div class="widget">
                    <h3>Total Certificates</h3>
                    <p><?php echo number_format($total_certificates); ?></p>
                </div>
            </section>

            <!-- Chart Section -->
            <section class="chart-section">
                <div class="chart">
                    <h3>Students Over Time</h3>
                    <canvas id="revenueChart"></canvas>
                </div>
            </section>
        </div>
    </div>

    <script>
        // Get the data from PHP
        const months = <?php echo json_encode($months); ?>;
        const studentCounts = <?php echo json_encode($student_counts); ?>;

        // Sample chart using Chart.js
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months.map(month => {
                    const date = new Date(2021, month - 1);
                    return date.toLocaleString('default', { month: 'short' });
                }),
                datasets: [{
                    label: 'Students',
                    data: studentCounts,
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.2)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</body>

</html>