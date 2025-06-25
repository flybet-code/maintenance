<?php
session_start();
include('db_connection.php'); // include your database connection

if(isset($_POST['upload'])) {
    $user_id = $_SESSION['user_id']; // Assuming the user is logged in and their ID is stored in session
    $file = $_FILES['profile_picture'];

    // Check if the file is an image
    $file_type = mime_content_type($file['tmp_name']);
    if(strpos($file_type, 'image') === false) {
        echo "Please upload a valid image file.";
        exit;
    }

    // Generate a unique name for the image
    $file_name = $user_id . "_" . time() . "_" . basename($file['name']);
    $target_dir = "uploads/profile_pictures/";
    $target_file = $target_dir . $file_name;

    // Move the uploaded file to the server
    if(move_uploaded_file($file['tmp_name'], $target_file)) {
        // Update the user's profile picture in the database
        $query = "UPDATE users SET profile_picture = '$file_name' WHERE user_id = $user_id";
        if(mysqli_query($conn, $query)) {
            echo "Profile picture updated successfully!";
        } else {
            echo "Error updating profile picture in the database.";
        }
    } else {
        echo "Error uploading the file.";
    }
}
?>
