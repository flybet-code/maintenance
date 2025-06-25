<?php
// Start the session
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database configuration
include('config/db.php');

// Fetch user counts by role (staff, admin, user)
$userCountSql = "SELECT role, COUNT(*) as count FROM users GROUP BY role";
$userCountResult = $conn->query($userCountSql);

// Store counts in an array
$userCounts = [];
if ($userCountResult) {
    while ($row = $userCountResult->fetch_assoc()) {
        $userCounts[$row['role']] = $row['count'];
    }
}

// Check if query for user counts is successful
if ($userCountResult === false) {
    echo "Error: " . $conn->error;
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Count</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #34495e;
            margin-bottom: 20px;
        }

        .stats {
            font-size: 1.5rem;
            margin-top: 30px;
        }

        .stats p {
            font-weight: bold;
            color: #3498db;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>User Role Statistics</h1>

    <div class="stats">
        <p>Total Users: <?php echo isset($userCounts['user']) ? $userCounts['user'] : 0; ?></p>
        <p>Total Staff: <?php echo isset($userCounts['staff']) ? $userCounts['staff'] : 0; ?></p>
        <p>Total Admins: <?php echo isset($userCounts['admin']) ? $userCounts['admin'] : 0; ?></p>
    </div>
</div>

</body>
</html>
