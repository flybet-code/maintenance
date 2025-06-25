<?php
include('config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_name = $_POST['employee_name'];
    $room = $_POST['room'];
    $research_type = $_POST['research_type'];
    $issue_description = $_POST['issue_description'];
    $status = 'Pending'; // Default status
    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO maintenance_requests (employee_name, room, research_type, issue_description, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ssssss', $employee_name, $room, $research_type, $issue_description, $status, $created_at);
        if ($stmt->execute()) {
            echo "Maintenance request submitted successfully!";
            header("Location: staff_dashboard.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
