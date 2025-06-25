<?php
// Start the session
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

// Include database configuration
include('config/db.php');

// Fetch the user's ID from the session
$user_id = $_SESSION['user_id'];

// SQL query to fetch only the approved requests for the logged-in user
$sql = "SELECT * FROM maintenance_requests WHERE user_id = ? AND status = 'approved'";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if query is successful
if ($result === false) {
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
    <title>View Approved Requests</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #34495e;
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
            background-color: #3498db;
            color: white;
        }

        .status-approved {
            background-color: #28a745;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }

        .status-pending {
            background-color: #f39c12;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Your Approved Maintenance Requests</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Request ID</th>
                <th>Employee Name</th>
                <th>Room</th>
                <th>Research Type</th>
                <th>Issue Description</th>
                <th>Status</th>
            </tr>
            <?php while ($request = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $request['request_id']; ?></td>
                    <td><?php echo $request['employee_name']; ?></td>
                    <td><?php echo $request['room']; ?></td>
                    <td><?php echo $request['research_type']; ?></td>
                    <td><?php echo $request['issue_description']; ?></td>
                    <td class="status-approved">
                        <?php echo $request['status']; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No approved requests found.</p>
    <?php endif; ?>
</div>

</body>
</html>
