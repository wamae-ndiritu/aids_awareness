<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$post_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $post_id, $user_id, $content);

    if ($stmt->execute()) {
        header("Location: view_post.php?id=" . $post_id);
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$stmt = $conn->prepare("SELECT p.title, p.content, p.image_url, p.created_at, u.username FROM posts p JOIN users u ON p.user_id = u.id WHERE p.id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->bind_result($title, $content, $image_url, $created_at, $username);
$stmt->fetch();
$stmt->close();

$comments_stmt = $conn->prepare("SELECT c.content, c.created_at, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = ? ORDER BY c.created_at DESC");
$comments_stmt->bind_param("i", $post_id);
$comments_stmt->execute();
$comments_stmt->store_result();
$comments_stmt->bind_result($comment_content, $comment_created_at, $comment_username);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Post</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<?php include 'includes/header.php'; ?>
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6"><?php echo htmlspecialchars($title); ?></h1>
    <?php if ($image_url): ?>
            <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Post Image" class="mb-4 h-96 w-full object-cover">
    <?php endif; ?>
    <p><?php echo nl2br(htmlspecialchars($content)); ?></p>
    <small class="text-gray-600"><?php echo $created_at; ?> by <?php echo htmlspecialchars($username); ?></small>
    
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-4">Comments</h2>
        <?php while ($comments_stmt->fetch()): ?>
                <div class="border p-4 mb-4">
                    <p><?php echo nl2br(htmlspecialchars($comment_content)); ?></p>
                    <small class="text-gray-600"><?php echo $comment_created_at; ?> by <?php echo htmlspecialchars($comment_username); ?></small>
                </div>
        <?php endwhile; ?>
    </div>
    
    <form action="view_post.php?id=<?php echo $post_id; ?>" method="post" class="mt-10">
        <div class="mb-4">
            <label class="block text-gray-700">Add a Comment</label>
            <textarea name="content" class="w-full p-2 border border-gray-300 rounded mt-1" required></textarea>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Post Comment</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>
<?php
$comments_stmt->close();
$conn->close();
?>
