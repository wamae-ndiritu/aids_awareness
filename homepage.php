<?php
// Start session to access session variables
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Include database connection
include 'config.php';

// Get user information from session
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];

// Display welcome message to the logged-in user
echo "<h1>Welcome, $username!</h1>";

// Here you can add additional content for the homepage
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>

<body>
    <h2>Homepage</h2>
    <p>This is the homepage content.</p>
    <p>You can add more content here.</p>
    <p><a href="logout.php">Logout</a></p>
</body>

</html>