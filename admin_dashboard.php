<?php
// admin_dashboard.php

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php'); // Redirect to login if not logged in as admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
            color: #333;
        }

        /* Sidebar Navigation */
        .sidebar {
            width: 220px;
            background-color: #2c3e50;
            padding-top: 30px;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: white;
            padding: 12px 20px;
            margin: 8px 0;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #3498db;
        }

        /* Content Area */
        .content {
            margin-left: 240px;
            padding: 40px;
            width: calc(100% - 240px);
        }

        .dashboard-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .dashboard-container h1 {
            margin-bottom: 20px;
            color: #333;
            animation: slideInTop 0.8s ease-out;
        }

        .button {
            display: inline-block;
            text-decoration: none;
            color: white;
            background-color: #0078ff;
            font-weight: bold;
            padding: 12px 24px;
            margin: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .button:hover {
            background-color: #005bb5;
            transform: scale(1.05);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInTop {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="admin_add.php">Add New User</a>
    <a href="view_all.php">View All user</a>
    <a href="notifications.php">Notifications</a>
    <a href="logout.php">Logout</a>
</div>

<!-- Main Content -->
<div class="content">
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>
        <p>Welcome to your admin dashboard. You can manage users, view requests, and more.</p><br>
        
    </div>
</div>

</body>
</html>
