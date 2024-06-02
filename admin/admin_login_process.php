<?php
session_start();
require '../config/db.php'; // Include the database configuration file

// Function to sanitize input data
function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    // Validate the inputs
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Please fill in both fields.";
        header("Location: login.php");
        exit();
    }

    // Prepare and execute the query to fetch the user
    $stmt = $conn->prepare("SELECT id, username, password, is_admin FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password, $is_admin);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            if ($is_admin) {
                // Set session variables and redirect to the admin dashboard
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['is_admin'] = $is_admin;
                header("Location: dashboard.php");
                exit();
            } else {
                $_SESSION['error'] = "You do not have admin privileges.";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid password.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "User not found.";
        header("Location: login.php");
        exit();
    }

    // $stmt->close();
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: login.php");
    exit();
}

// $conn->close();
?>