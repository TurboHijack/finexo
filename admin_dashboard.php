<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Finexo</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <nav>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link" href="user_management.php">User Management</a></li>
                <li class="nav-item"><a class="nav-link" href="active_cases.php">Active Cases</a></li>
                <li class="nav-item"><a class="nav-link" href="closed_cases.php">Closed Cases</a></li>
                <li class="nav-item"><a class="nav-link" href="generate_reports.php">Reports</a></li>
                <li class="nav-item"><a class="nav-link" href="system_settings.php">System Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="content">
            <h3>Welcome, Admin <?php echo $_SESSION['username']; ?></h3>
            <!-- Additional admin dashboard content -->
        </div>
    </div>
</body>
</html>
