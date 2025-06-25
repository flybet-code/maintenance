<?php
// index.php

session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php'); // Redirect to dashboard if already logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Maintenance Form</title>
</head>
<body>
    <h1>Welcome to the Maintenance Request System</h1>
    <p><a href="register.php">Register</a> | <a href="login.php">Login</a></p>
</body>
</html>
