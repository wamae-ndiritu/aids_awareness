<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

require '../config/db.php';

// Check if post ID is provided
if (!isset($_POST['post_id'])) {
    header("Location: dashboard.php");
    exit();
}

$post_id = intval($_POST['post_id']);

// Fetch the current flagged status
$query = "SELECT flagged FROM posts WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    header("Location: dashboard.php");
    exit();
}

// Toggle the flagged status
$new_flagged_status = !$post['flagged'];

$update_query = "UPDATE posts SET flagged = ? WHERE id = ?";
$update_stmt = $conn->prepare($update_query);
$update_stmt->bind_param("ii", $new_flagged_status, $post_id);
$update_stmt->execute();

header("Location: view_post.php?id=" . $post_id);
exit();
?>
