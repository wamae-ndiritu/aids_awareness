<?php
// Include database connection
include 'config/db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Prepare SQL statement to insert user data into database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Registration successful!";
        // Redirect user to login page
        header("Location: login.php");
        exit();
    } else {
        echo "Error executing";
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}
