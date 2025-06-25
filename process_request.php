<?php
include('config/db.php');

// Ensure request method is POST and a request ID is provided
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'] ?? '';

    // Update the status and remarks in the database
    $sql = "UPDATE maintenance_requests SET status = ?, remarks = ? WHERE request_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ssi', $status, $remarks, $request_id);

        if ($stmt->execute()) {
            echo "Request processed successfully!";
            header("Location: staff_dashboard.php?message=success");
            exit();
        } else {
            echo "Error updating request: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
