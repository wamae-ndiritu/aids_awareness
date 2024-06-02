<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

require '../config/db.php';

// Fetch posts from the database
$query = "SELECT posts.id, users.username, posts.title, posts.content, posts.created_at, posts.flagged
          FROM posts 
          JOIN users ON posts.user_id = users.id 
          ORDER BY posts.created_at DESC";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin Dashboard - HIV/AIDS Awareness Platform</title>
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
        <h2 class="text-3xl font-semibold text-gray-800">All Posts</h2>
        <div class="overflow-x-auto mt-4">
            <table class="w-max md:min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Username</th>
                        <th class="py-2 px-4 border-b text-left">Title</th>
                        <th class="py-2 px-4 border-b text-left">Created At</th>
                        <th class="py-2 px-4 border-b text-left">Status</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['id']); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['username']); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['title']); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['created_at']); ?></td>
                                <td class="py-2 px-4 border-b">
                                    <span class="px-4 py-1 rounded <?php echo $row['flagged'] ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600'; ?>">
                                        <?php echo $row['flagged'] ? 'Flagged' : 'Not Flagged'; ?>
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <a href="view_post.php?id=<?php echo $row['id']; ?>" class="text-blue-500">View</a>
                                    <a href="flag_post.php?id=<?php echo $row['id']; ?>" class="text-red-500 ml-2">Flag</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-2 px-4 border-b text-center">No posts found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>

<?php $conn->close(); ?>
