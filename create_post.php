<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $image_url = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = basename($_FILES['image']['name']);
        $image_path = 'uploads/' . $image_name;

        // Debug: Check if uploads directory exists and is writable
        if (!is_dir('uploads')) {
            echo "Uploads directory does not exist.";
        } elseif (!is_writable('uploads')) {
            echo "Uploads directory is not writable.";
        } else {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                $image_url = $image_path;
                echo "Image uploaded successfully: <a href='$image_url'>$image_name</a>";
            } else {
                echo "Error uploading the image.";
            }
        }
    } else {
        // Debug: Output error message if file upload fails
        if (isset($_FILES['image']['error'])) {
            switch ($_FILES['image']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo "The uploaded file was only partially uploaded.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "No file was uploaded.";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    echo "Missing a temporary folder.";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    echo "Failed to write file to disk.";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    echo "File upload stopped by extension.";
                    break;
                default:
                    echo "Unknown upload error.";
                    break;
            }
        } else {
            echo "No file was uploaded or an unknown error occurred.";
        }
    }

    $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content, image_url) VALUES (?, ?, ?, ?)");
    echo $image_url;
    $stmt->bind_param("isss", $user_id, $title, $content, $image_url);

    if ($stmt->execute()) {
        header("Location: homepage.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<?php include 'includes/header.php'; ?>
<div class="max-w-md mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Create New Post</h1>
    <form action="create_post.php" method="post" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block text-gray-700">Title</label>
            <input type="text" name="title" class="w-full p-2 border border-gray-300 rounded mt-1" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Content</label>
            <textarea name="content" class="w-full p-2 border border-gray-300 rounded mt-1" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Image</label>
            <input type="file" name="image" class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Create Post</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>
