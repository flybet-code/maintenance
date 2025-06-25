<?php
// maintenance_request.php

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

include('config/db.php');

// Variable to store success/error messages
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_name = $_POST['employee_name'];
    $room = $_POST['room'];
    $research_type = $_POST['research_type'];
    $issue_description = $_POST['issue_description'];
    $status = 'Pending';  // Default status when a report is created

    // Prepare the SQL query to insert the data into the database
    $sql = "INSERT INTO maintenance_requests (employee_name, room, research_type, issue_description, status) 
            VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('sssss', $employee_name, $room, $research_type, $issue_description, $status);

        if ($stmt->execute()) {
            $message = "Maintenance report submitted successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Maintenance Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
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
        }

        h1 {
            text-align: center;
            color: #34495e;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2980b9;
        }

        .message {
            text-align: center;
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .success {
            background-color: #28a745;
            color: white;
        }

        .error {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Submit Maintenance Report</h1>

    <!-- Display success or error message -->
    <?php if ($message): ?>
        <div class="message <?php echo (strpos($message, 'success') !== false) ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form action="maintenance_request.php" method="POST">
      <label for="employee_name">Employee Name:</label>
      <input type="text" name="employee_name" required><br><br>

      <label for="room">Room:</label>
      <input type="text" name="room" required><br><br>

      <label for="research_type">Research Type:</label>
    <select name="research_type" required>
        <option value="Computer">Computer</option>
        <option value="Printer">Printer</option>
        <option value="Photocopy">Photocopy</option>
        <option value="Other">Other</option>
    </select><br><br>

    <label for="issue_description">Issue Description:</label>
    <textarea name="issue_description" required></textarea><br><br>

    <button type="submit">Submit Maintenance Report</button>
</form>

</div>

</body>
</html>
