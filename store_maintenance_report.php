<?php
include('config/db.php'); // Include database connection

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
            echo "Maintenance report submitted successfully!";
            header("Location: staff_dashboard.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Database error: " . $conn->error;
    }

    $conn->close();
}
?>
