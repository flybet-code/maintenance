<?php
// notifications.php

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

include('config/db.php');
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM notifications WHERE user_id = ?";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h1>Notifications</h1>";
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . $row['message'] . "<br>Status: " . $row['status'] . "</p><hr>";
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
