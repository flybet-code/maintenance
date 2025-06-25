<?php
// admin_add.php - Approve the maintenance request

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Include database configuration
include('config/db.php');

// Check if the request ID is passed and update the status to 'Approved'
if (isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];

    // Update the request status to 'Approved'
    $sql = "UPDATE maintenance_requests SET status = 'Approved' WHERE request_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $request_id);
    $stmt->execute();

    // Redirect back to the admin dashboard or view requests page
    header('Location: view_requests.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User - Admin</title>
    <style>
        /* Add some basic styling for the form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin: 0 auto;
        }
        .form-container input,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<h1>Add New User (No Login Required)</h1>

<div class="form-container">
    <!-- Success or Error Message -->
    <?php if (isset($success_msg)): ?>
        <div class="message success"><?php echo $success_msg; ?></div>
    <?php elseif (isset($error_msg)): ?>
        <div class="message error"><?php echo $error_msg; ?></div>
    <?php endif; ?>

    <!-- Form to add new user -->
    <form action="admin_add.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="role">Role:</label>
        <select name="role" required>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>

        <button type="submit">Add User</button>
    </form>
</div>

</body>
</html>
