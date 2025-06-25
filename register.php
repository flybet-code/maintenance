<?php
// register.php

include('config/db.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input from form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
    $role = 'user'; // Default role for new users

    // Prepare SQL query to insert data into the users table
    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ssss', $name, $email, $password, $role);
        
        if ($stmt->execute()) {
            echo "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>

<style>

/* assets/css/styles.css */

/* Body Styling */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f0f2f5; /* Light Facebook gray */
    margin: 0;
    padding: 0;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Full height for centering */
    overflow: hidden; /* Prevent page overflow during animation */
}

/* Header Section */
header {
    background-color: #1877f2; /* Facebook blue */
    padding: 20px 0;
    color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.site-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 2.5rem;
    text-decoration: none;
    color: white;
}

.navbar ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.navbar li {
    margin-left: 20px;
}

.navbar a {
    text-decoration: none;
    color: white;
    font-weight: 500;
    font-size: 1rem;
    transition: color 0.3s ease;
}

.navbar a:hover {
    color: #2980b9;
}

/* Form Container Styling */
.form-container {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 1s ease-out forwards;
}

/* Title Styling */
.title {
    text-align: center;
    font-size: 2.5rem;  /* Increased font size */
    font-weight: bold;
    color: #1877f2;
    margin-bottom: 20px;
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.5s ease-out 0.3s forwards; /* Animation delay for title */
}

/* Form Styling */
.register-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 1s ease-out 0.7s forwards; /* Animation delay for form */
}

input {
    padding: 14px 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1.1rem;  /* Increased font size */
    width: 100%;
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(20px);
    animation: slideIn 0.5s ease-out forwards;
}

input:focus {
    border-color: #1877f2;
    outline: none;
    box-shadow: 0 0 8px rgba(24, 119, 242, 0.8); /* Blue glow effect */
}

input:nth-child(1) {
    animation-delay: 0.3s;
}

input:nth-child(2) {
    animation-delay: 0.4s;
}

input:nth-child(3) {
    animation-delay: 0.5s;
}

input:nth-child(4) {
    animation-delay: 0.6s;
}

/* Submit Button */
.submit-btn {
    background-color: #1877f2;
    color: white;
    padding: 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2rem;  /* Increased font size */
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInButton 1s ease-out 1s forwards;
}

.submit-btn:hover {
    background-color: #165e9b;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInButton {
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
    
    
</style>
<body>
    <form action="register.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
