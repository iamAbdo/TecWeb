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

            <!-- Dashboard widgets -->
            <section class="dashboard-widgets">
                <div class="widget">
                    <h3>Total Users</h3>
                    <p>1,234</p>
                </div>
                <div class="widget">
                    <h3>Revenue</h3>
                    <p>$45,000</p>
                </div>
                <div class="widget">
                    <h3>Orders</h3>
                    <p>56</p>
                </div>
                <div class="widget">
                    <h3>Active Sessions</h3>
                    <p>12</p>
                </div>
            </section>

            <!-- Chart Section -->
            <section class="chart-section">
                <div class="chart">
                    <h3>Revenue Over Time</h3>
                    <canvas id="revenueChart"></canvas>
                </div>
            </section>

            <!-- Table Section -->
            <section class="table-section">
                <h3>Recent Activity</h3>
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Activity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>Created a new post</td>
                            <td>2024-12-25</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Commented on a post</td>
                            <td>2024-12-24</td>
                        </tr>
                        <tr>
                            <td>Sam Brown</td>
                            <td>Logged in</td>
                            <td>2024-12-23</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>