<?php
// Start the session
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

// Include database configuration
include('config/db.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_name = $_POST['employee_name'];
    $room = $_POST['room'];
    $research_type = $_POST['research_type'];
    $issue_description = $_POST['issue_description'];

    $sql = "INSERT INTO maintenance_requests (employee_name, room, research_type, issue_description, status) 
            VALUES (?, ?, ?, ?, 'Pending')";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ssss', $employee_name, $room, $research_type, $issue_description);
        
        if ($stmt->execute()) {
            echo "Maintenance request submitted successfully!";
        } else {
            echo "Error: " . $stmt->error;
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
        /* Styling goes here (same as before) */
    </style>
</head>
<body>

<div class="container">
    <h1>Submit Maintenance Report</h1>
    
    <form action="submit_maintenance_report.php" method="POST">
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
