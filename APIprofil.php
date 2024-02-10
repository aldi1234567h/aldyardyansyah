<?php
session_start();
header("Access-Control-Allow-Origin: *");
include ('../koneksi/koneksi.php');

// Check if the user is logged in, implement your own authentication mechanism
// For example, you can use a session variable to check if the user is authenticated.

if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to login page if not authenticated
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the current password (implement your own validation logic)
    $user_id = $_SESSION['id'];
    $stored_password = "hashed_password_here"; // Replace with the actual hashed password from your database
    
    // Implement proper password verification mechanism (e.g., password_hash and password_verify)
    if (password_verify($current_password, $stored_password)) {
        // Validate and match new password and confirm password
        if ($new_password == $confirm_password) {
            // Implement password update logic (e.g., update the password in the database)
            // $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            // Update the password in the database using the user_id

            // Redirect to a success page or home page
            header("Location: login.php");
            exit();
        } else {
            echo "New password and confirm password do not match.";
        }
    } else {
        echo "Invalid current password.";
    }
}
?>