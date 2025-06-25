<?php
// Start the session
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

// Include database configuration
include('config/db.php');

// Logout functionality
if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session
    header('Location: login.php'); // Redirect to login page
    exit();
}

// Fetch maintenance requests if needed
$maintenanceRequests = null;
if (isset($_GET['page']) && $_GET['page'] === 'maintenance_requests') {
    $sql = "SELECT * FROM maintenance_requests WHERE status = 'Pending' OR status = 'Approved'";
    $maintenanceRequests = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navbar Styles */
        nav {
            background-color:rgb(17, 5, 126);
            padding: 15px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: center; /* Center the navbar items */
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
        }

        nav ul li a:hover {
            background-color:rgb(120, 130, 139);
        }

        /* Container for main content */
        .container {
            width: 80%;
            margin: 80px auto 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color:rgb(18, 23, 27);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color:rgb(17, 19, 156);
            color: white;
        }

        .button {
            background-color: #3498db;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            margin: 5px;
        }

        .button:hover {
            background-color: #2980b9;
        }

        .button.approve {
            background-color: #28a745;
        }

        .button.approve:hover {
            background-color: #218838;
        }

        .button.reschedule {
            background-color: #f39c12;
        }

        .button.reschedule:hover {
            background-color: #e67e22;
        }

        .button.view {
            background-color: #3498db;
        }

        .button.view:hover {
            background-color: #2980b9;
        }

        /* Logout button style */
        .logout-btn {
            background-color: #e74c3c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav>
    <ul>
        <li><a href="staff_dashboard.php?page=dashboard">Dashboard</a></li>
        <li><a href="staff_dashboard.php?page=maintenance_requests">Maintenance Requests</a></li>
        <form method="POST" style="margin: 0;">
            <li><button type="submit" name="logout" class="logout-btn">Logout</button></li>
        </form>
    </ul>
</nav>

<div class="container">
    <?php
    // Display content based on the page
    if (isset($_GET['page']) && $_GET['page'] === 'maintenance_requests') {
        // Display Maintenance Requests
        echo "<h1>Maintenance Requests</h1>";
        if ($maintenanceRequests && $maintenanceRequests->num_rows > 0) {
            echo "<table>
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Employee Name</th>
                            <th>Room</th>
                            <th>Research Type</th>
                            <th>Issue Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = $maintenanceRequests->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['request_id'] . "</td>
                        <td>" . $row['employee_name'] . "</td>
                        <td>" . $row['room'] . "</td>
                        <td>" . $row['research_type'] . "</td>
                        <td>" . $row['issue_description'] . "</td>
                        <td>" . $row['status'] . "</td>
                        <td>
                            <form action='staff_dashboard.php' method='POST'>
                                <input type='hidden' name='request_id' value='" . $row['request_id'] . "'>
                                <button class='button approve' name='approve'>Approve</button>
                                <button class='button reschedule' name='reschedule'>Reschedule</button>
                                <button class='button view' name='view'>View</button>
                            </form>
                        </td>
                    </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No pending requests found.</p>";
        }
    } else {
        // Default to Dashboard (Welcome text)
        echo "<h1>Welcome to the Staff Dashboard</h1>";
        echo "<p>Select a section from the navigation menu.</p>";
    }
    ?>
</div>

<script>
    // Example function to handle "View" button click
    function viewRequest(requestId) {
        alert('Viewing details for Request ID: ' + requestId);
        // Redirect to a new page or show details in a modal
        // For example: window.location.href = 'view_request.php?id=' + requestId;
    }
</script>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
