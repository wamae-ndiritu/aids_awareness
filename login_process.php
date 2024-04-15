<?php
// Include database connection
include 'config/db.php';
// Start a session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare SQL statement to retrieve user data from database
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists and password is correct
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Password is correct, set session variables
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];

            // Redirect user to homepage
            header("Location: homepage.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    // Close database connection
    $stmt->close();
    $conn->close();
}
?>
