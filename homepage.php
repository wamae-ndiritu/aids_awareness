<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT id, title, content, image_url, created_at FROM posts WHERE flagged=0 ORDER BY created_at DESC");
// $stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($post_id, $title, $content, $image_url, $created_at);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="max-w-2xl mx-auto mt-10">
        <div class="flex justify-between items-center border rounded p-2 my-2">
            <a href="my-account.php" class="flex items-center">
                <!-- User profile image -->
                 <img src="<?php echo $profile_pic ? htmlspecialchars($profile_pic) : 'images/default_profile.jpeg'; ?>" alt="Profile Picture" class="mt-2 w-16 h-16 object-cover rounded-full">

                <!-- User name -->
                <span class="text-gray-800 font-semibold ml-4"><?php echo $username; ?></span>
            </a>

            <!-- Add new post button -->
            <a href="create_post.php" class="bg-red-500 text-white p-2 rounded">
                New Post
            </a>
        </div>

        <?php while ($stmt->fetch()): ?>
            <div class="border p-4 mb-4">
                <h2 class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($title); ?></h2>
                <?php if ($image_url): ?>
                    <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Post Image"
                        class="mb-4 h-96 object-contain">
                <?php endif; ?>
                <p><?php echo nl2br(htmlspecialchars($content)); ?></p>
                <small class="text-gray-600"><?php echo $created_at; ?></small>
                <a href="view_post.php?id=<?php echo $post_id; ?>" class="text-blue-500 block mt-2">View Comments</a>
            </div>
        <?php endwhile; ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>

</html>
<?php
$stmt->close();
$conn->close();
?>