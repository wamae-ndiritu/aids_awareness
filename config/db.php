<?php
// Database configuration
$db_host = "localhost";
$db_username = "wamae";
$db_password = "@engjineering392N";
$db_name = "aids_awareness";

// Establish database connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
