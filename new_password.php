<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['password2'];

    // Check if the passwords match
    if ($new_password !== $confirm_password) {
        echo "Passwords do not match. Please try again.";
        exit;
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare('SELECT * FROM users WHERE reset_token = ?');
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        $stmt = $pdo->prepare('UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?');
        if ($stmt->execute([$hashed_password, $token])) {
            echo "Password has been updated. <a href='login.php'>Login here</a>.";
        } else {
            echo "Error updating password.";
        }
    } else {
        echo "Invalid token.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>HIV/AIDS Awareness Platform - Reset Password</title>
</head>

<body>
    <section class="h-screen grid grid-cols-1 md:grid-cols-2 font-sans">
        <div class="col-span-1 p-4 flex flex-col justify-center items-center bg-red-600">
            <img src="images/hiv-awareness-ribbon.jpeg" alt="HIV/AIDS Awareness" class="w-48 h-52 object-cover">
            <h1 class="text-3xl font-normal my-3 text-white">Creating HIV & AIDS Awareness</h1>
            <h6 class="text-white my-1 px-1 md:px-16 text-md">
                Welcome to our HIV/AIDS awareness platform. Your presence here signifies a commitment to learning,
                sharing knowledge, and taking action to make a positive difference. Thank you for being a part of our
                efforts to raise awareness and promote inclusivity in the fight against HIV/AIDS.
            </h6>
        </div>
        <div class="col-span-1 flex flex-col items-center justify-center">
            <div class="md:w-4/5">
                <h1 class="text-2xl text-red-500 my-3 font-semibold">Reset Password</h1>
                <form action="new_password.php" method="post" class="w-full">
                    <div class="flex flex-col">
                        <label for="password" class="my-1">New Password</label>
                        <input type="password" id="password" name="password" class="border p-2 rounded focus:outline-red-500"
                            required><br>
                    </div>
                    <div class="flex flex-col">
                        <label for="password2" class="my-1">Confirm Password</label>
                        <input type="password" id="password2" name="password2" class="border p-2 rounded focus:outline-red-500"
                            required><br>
                    </div>
                    <input type="submit" value="Set New Password"
                        class="w-full bg-red-600 text-white text-xl px-2 py-1 rounded focus:outline-red-500">
                </form>
            </div>
        </div>
    </section>
</body>

</html>