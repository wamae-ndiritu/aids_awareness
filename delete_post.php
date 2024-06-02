<?php
session_start();

include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $post_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Check if the post belongs to the logged-in user
    $stmt = $conn->prepare("SELECT id FROM posts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // echo "Deleting...";
        // Delete the post
        $delete_stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
        $delete_stmt->bind_param("i", $post_id);
        echo $post_id;
        if ($delete_stmt->execute()) {
            echo "Deleted successfully";
            $delete_stmt->close();
            header("Location: my_posts.php");
            exit();
        } else {
            echo "Error executing deletion query: " . $delete_stmt->error;
        }

        // Redirect back to my_posts.php after deletion
        header("Location: my_posts.php");
        exit();
    } else {
        // Redirect to an error page if the post doesn't belong to the user
        // header("Location: error.php");
        header("Location: my_posts.php");
        exit();
    }
} else {
    // Redirect to an error page if post ID is not provided
    // header("Location: error.php");
    header("Location: my_posts.php");
    exit();
}

// $conn->close();

