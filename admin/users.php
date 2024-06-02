<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

require '../config/db.php';

// Fetch users from the database
$query = "SELECT * FROM users";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>User Management - HIV/AIDS Awareness Platform</title>
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
            <h1 class="text-2xl font-semibold">User Management</h1>
        </div>
        <nav class="flex flex-col p-4 space-y-2">
            <a href="dashboard.php" class="py-2 px-4 bg-gray-900 rounded mb-1">Posts</a>
            <a href="users.php" class="py-2 px-4 bg-gray-900 rounded mb-1">Users</a>
            <a href="logout.php" class="py-2 px-4 bg-gray-900 rounded mb-1">Logout</a>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="main-content p-4">
        <h2 class="text-3xl font-semibold text-gray-800">All Users</h2>
        <div class="overflow-x-auto mt-4">
            <table class="w-max md:min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">ID</th>
                        <th class="py-2 px-4 border-b text-left">Username</th>
                        <th class="py-2 px-4 border-b text-left">Email</th>
                        <th class="py-2 px-4 border-b text-left">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['id']); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['username']); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($row['created_at']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="py-2 px-4 border-b text-center">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>

<?php $conn->close(); ?>
