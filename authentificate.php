<?php
session_start(); // Start the session

// Dummy username and password for demonstration purposes
$valid_username = "admin";
$valid_password = "password";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate login credentials
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['logged_in'] = true; // Set session variable to indicate login
        header("Location: index.php"); // Redirect to the main page if login is successful
        exit(); // Ensure no further code is executed
    } else {
        header("Location: login.php?error=1"); // Redirect back to login page with an error
        exit(); // Ensure no further code is executed
    }
} else {
    // Redirect to login page if the request method is not POST
    header("Location: login.php");
    exit(); // Ensure no further code is executed
}
?>
