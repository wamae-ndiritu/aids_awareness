<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

require '../config/db.php';

// Check if post ID is provided
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$post_id = intval($_GET['id']);

// Fetch the post details from the database
$query = "SELECT posts.id, users.username, posts.title, posts.content, posts.image_url, posts.created_at, posts.flagged
          FROM posts 
          JOIN users ON posts.user_id = users.id 
          WHERE posts.id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    header("Location: dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>View Post - HIV/AIDS Awareness Platform</title>
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            width: 16rem;
        }
        .main-content {
            margin-left: 16rem;
            overflow-y: auto;
            height: 100vh;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <aside class="sidebar bg-red-600 text-white flex flex-col">
        <div class="p-4">
            <h1 class="text-2xl font-semibold">Admin Dashboard</h1>
        </div>
        <nav class="flex flex-col p-4 space-y-2">
            <a href="dashboard.php" class="py-2 px-4 bg-gray-900 rounded mb-1">Posts</a>
            <a href="users.php" class="py-2 px-4 bg-gray-900 rounded mb-1">Users</a>
            <a href="logout.php" class="py-2 px-4 bg-gray-900 rounded mb-1">Logout</a>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="main-content p-4">
        <div class="bg-white md:w-1/2 p-4 mb-5">
            <h2 class="text-3xl font-semibold text-gray-800"><?php echo htmlspecialchars($post['title']); ?></h2>
            <p class="mt-2 text-gray-600">By <?php echo htmlspecialchars($post['username']); ?> on <?php echo htmlspecialchars($post['created_at']); ?></p>
            <div class="mt-4">
                <?php if ($post['image_url']): ?>
                    <img src="../<?php echo htmlspecialchars($post['image_url']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="w-full h-96 object-contain border border-gray-300">
                <?php endif; ?>
                <p class="mt-4 text-gray-800"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            </div>
            <div class="mt-4">
                <form action="flag_post.php" method="post">
                    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id']); ?>">
                    <button type="submit" class="bg-red-800 text-white px-4 py-2 rounded"><?php echo $post['flagged'] ? 'Unflag Post' : 'Flag Post'; ?></button>
                </form>
            </div>
        </div>
        <a href="dashboard.php" class="bg-red-600 text-white px-4 py-2 rounded mt-5">View All Posts</a>
    </main>
</body>

</html>

<?php $conn->close(); ?>
