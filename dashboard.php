<?php
// Start session
session_start();

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Generate CSRF token if not already set
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f3f4f6;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background-color: rgb(6, 17, 122);
            padding: 1rem;
            display: flex;
            justify-content: center;
            box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        .navbar ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .navbar ul li a:hover,
        .navbar ul li a.active {
            background-color: rgba(159, 155, 165, 0.49);
            transform: scale(1.1);
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            border: 8px solid #f3f4f6;
            border-top: 8px solid #0078ff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Dashboard Container */
        .dashboard-container {
            max-width: 900px;
            margin: 5% auto;
            padding: 2rem;
            background-color: white;
            box-shadow: 0px 4px 8px rgba(219, 17, 17, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        /* Confirmation Message */
        #confirmationMessage {
            margin-top: 10px;
            color: green;
            font-weight: bold;
            display: none;
        }

        #confirmationMessage.slide-up {
            display: block;
            animation: slideUp 1s forwards;
        }

        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <!-- Loading Spinner -->
    <div class="loading-overlay" id="loading" aria-live="polite" aria-busy="true">
        <div class="spinner" role="status">Loading...</div>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
        <ul>
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <li><a href="maintenance_request.php">Form</a></li>
            <li><a href="view_requests.php">View Requests</a></li>
            <li><a href="notifications.php">Notifications</a></li>
            <li><a href="update_profile.php">Update Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Dashboard Content -->
    <div class="dashboard-container">
        <h1>Welcome to Your Dashboard</h1>
        <p>Manage maintenance requests and your profile settings smoothly!</p><br>

        <!-- Action Button inside the Navigation Bar -->
        <nav class="navbar">
            <ul>
                <li><a href="#" id="confirmAction">Click Me for Animated Confirmation</a></li>
            </ul>
        </nav>

        <!-- Confirmation Message -->
        <div id="confirmationMessage">Appointment Confirmed Successfully!</div>
    </div>

    <script>
        // Smooth Page Loading
        window.onload = function () {
            document.getElementById('loading').style.display = 'none';
        };

        // Animated Confirmation Message
        document.getElementById('confirmAction').addEventListener('click', function () {
            const confirmationMessage = document.getElementById('confirmationMessage');
            confirmationMessage.classList.toggle('slide-up', true);
            setTimeout(() => confirmationMessage.classList.toggle('slide-up', false), 3000);
        });
    </script>
</body>
</html>
