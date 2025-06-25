<?php
include('config/db.php');

// Fetch request details by ID
if (isset($_GET['id'])) {
    $request_id = $_GET['id'];
    $sql = "SELECT * FROM maintenance_requests WHERE request_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $request_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<strong>Employee Name:</strong> " . $row['employee_name'] . "<br>";
            echo "<strong>Room:</strong> " . $row['room'] . "<br>";
            echo "<strong>Research Type:</strong> " . $row['research_type'] . "<br>";
            echo "<strong>Issue Description:</strong> " . $row['issue_description'] . "<br>";
            echo "<strong>Status:</strong> " . $row['status'] . "<br>";
        } else {
            echo "Request not found.";
        }
    } else {
        echo "Error fetching request details.";
    }
}
?>
