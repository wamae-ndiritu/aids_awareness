<?php
// Start a session
session_start();

// Check for errors
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : "";
unset($_SESSION["error"]); // Clear the error message

// Display error message if it exists
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>HIV/AIDS Awareness Platform - Login</title>
</head>

<body>
    <section class="h-screen grid grid-cols-1 md:grid-cols-2 font-sans">
        <div class="col-span-1 p-4 flex flex-col justify-center items-center bg-red-600">
            <img src="./images/hiv-awareness-ribbon.jpeg" alt="HIV/AIDS Awareness" class="w-48 h-52 object-cover">
            <h1 class="text-3xl font-normal my-3 text-white">Creating HIV & AIDS Awareness</h1>
            <h6 class="text-white my-1 px-1 md:px-16 text-md">
                Welcome to our HIV/AIDS awareness platform. Your presence here signifies a commitment to learning, sharing knowledge, and taking action to make a positive difference. Thank you for being a part of our efforts to raise awareness and promote inclusivity in the fight against HIV/AIDS.
            </h6>
        </div>
        <div class="col-span-1 flex flex-col items-center justify-center">
            <div class="md:w-4/5">
                <h1 class="text-2xl text-red-500 my-3 font-semibold">Welcome Back to HIV/Awareness Platform</h1>
            <?php
            if ($error) {
                echo "<p class='bg-orange-400 text-red-600 px-2 py-1 rounded'>$error</p>";
            }
            ?>
            <form action="login_process.php" method="post" class="w-full">
                <div class="flex flex-col">
                    <label for="username" class="my-1">Username</label>
                    <input type="text" id="username" name="username"
                        class="border p-2 rounded focus:outline-red-500" required><br>
                </div>
                <div class="flex flex-col">
                    <label for="password" class="my-1">Password</label>
                    <input type="password" id="password" name="password"
                        class="border p-2 rounded focus:outline-red-500" required><br>
                </div>
                <input type="submit" value="Login"
                    class="w-full bg-red-600 text-white text-xl px-2 py-1 rounded focus:outline-red-500">
                <div class="w-full flex justify-between">
                    <p class="py-2 text-sm text-gray-600 text-center">Don't have an account? <a href="register.php" class="text-red-500 underline">Register</a></p>
                    <a href="reset-password.php" class="py-2 text-sm text-red-500 underline">Forgot
                    password or Reset Password?</a>
                </div>
            </form>
            </div>
        </div>
    </section>
</body>

</html>