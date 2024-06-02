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
    <title>Admin Login - HIV/AIDS Awareness Platform</title>
</head>

<body>
    <section class="h-screen grid grid-cols-1 md:grid-cols-2 font-sans">
        <div class="col-span-1 p-4 flex flex-col justify-center items-center bg-red-600">
            <img src="../images/hiv-awareness-ribbon.jpeg" alt="HIV/AIDS Awareness" class="w-48 h-52 object-cover">
            <h1 class="text-3xl font-normal my-3 text-white">Admin Login</h1>
            <h6 class="text-white my-1 px-1 md:px-16 text-md">
                Welcome to the admin section of our HIV/AIDS awareness platform. Please log in with your admin
                credentials to access the dashboard and manage the platform.
            </h6>
        </div>
        <div class="col-span-1 flex flex-col items-center justify-center">
            <div class="md:w-4/5">
                <h1 class="text-2xl text-blue-500 my-3 font-semibold">Admin Login</h1>
                <?php
                if ($error) {
                    echo "<p class='bg-orange-400 text-red-600 px-2 py-1 rounded'>$error</p>";
                }
                ?>
                <form action="./admin_login_process.php" method="post" class="w-full">
                    <div class="flex flex-col">
                        <label for="username" class="my-1">Username</label>
                        <input type="text" id="username" name="username"
                            class="border p-2 rounded focus:outline-blue-500" required><br>
                    </div>
                    <div class="flex flex-col">
                        <label for="password" class="my-1">Password</label>
                        <input type="password" id="password" name="password"
                            class="border p-2 rounded focus:outline-blue-500" required><br>
                    </div>
                    <input type="submit" value="Login"
                        class="w-full bg-blue-800 text-white text-xl px-2 py-1 rounded focus:outline-blue-500">
                    <div class="w-full flex justify-between">
                        <a href="reset-password.php" class="py-2 text-sm text-blue-500 underline">Forgot
                            password or Reset Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>