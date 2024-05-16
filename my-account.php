<?php
// Include database connection
include 'config/db.php';

// Initialize variables
$username = "";
$email = "";
$password = "";

// Check if user is logged in
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch user details from database
$stmt = $conn->prepare("SELECT username, email, profile_pic FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($username, $email, $profile_pic);
$stmt->fetch();
$stmt->close();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if ($_FILES["profile_pic"]["size"] > 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            $profile_pic = $target_file;
        } else {
            echo "Error uploading profile picture.";
        }
    }

    // Prepare SQL statement to update user data in the database
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ?, profile_pic = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $username, $email, $password, $profile_pic, $user_id);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "User details updated successfully!";
        // Update session data if username or email was changed
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["profile_pic"] = $profile_pic;
    } else {
        echo "Error updating user details: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Account</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <?php include 'includes/header.php'; ?>
    <div class="max-w-2xl mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">My Account</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data"
            class="max-w-lg">
            <div class="mb-4 h-20 w-20 rounded-full relative">
                <label for="profile_pic" class="absolute bottom-2 right-0 bg-red-500 h-6 w-6 rounded-full text-white flex items-center justify-center">1</label>
                <input type="file" id="profile_pic" name="profile_pic" class="form-input mt-1 block w-full rounded-md" style="display: none">
                   <img src="<?php echo $profile_pic ? htmlspecialchars($profile_pic) : 'images/default_profile.jpeg'; ?>" alt="Profile Picture" class="mt-2 w-full h-full object-cover rounded-full">

            </div>
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>"
                    class="form-input mt-1 block w-full rounded-md">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                    class="form-input mt-1 block w-full rounded-md">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>"
                    class="form-input mt-1 block w-full rounded-md">
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>

</html>
<?php
$stmt->close();
$conn->close();
?>