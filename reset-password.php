<?php
// Include database connection
require 'config/db.php';

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $token = bin2hex(random_bytes(16));
        $expire = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expire = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expire, $email);

        if ($stmt->execute()) {
            $reset_link = "http://localhost:8080/aids-awareness-app/new_password.php?token=$token";

            // SMTP server settings
            $smtp_host = 'smtp.gmail.com';
            $smtp_port = 587; // TLS
            $smtp_username = 'v0793844124@gmail.com';
            $smtp_password = 'aixv rlzv wktj wzwn';

            // Email headers
            $headers = "From: $smtp_username";

            // Configure PHP to use SMTP
            ini_set('SMTP', $smtp_host);
            ini_set('smtp_port', $smtp_port);
            ini_set('sendmail_from', $smtp_username);

            // Send the reset link via email
            $to = $email;
            $subject = "Password Reset";
            $message = "Click the following link to reset your password: $reset_link";

            try {
                // Send the reset link via email
                if (mail($to, $subject, $message, $headers)) {
                    echo "Password reset link has been sent to your email.";
                } else {
                    throw new Exception("Failed to send email.");
                }
            } catch (Exception $e) {
                echo "Failed to send email. Error: " . $e->getMessage();
            }
        } else {
            echo "Failed to set reset token.";
        }
    } else {
        echo "No account found with that email.";
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
                <form action="reset-password.php" method="post" class="w-full">
                    <div class="flex flex-col">
                        <label for="email" class="my-1">Email</label>
                        <input type="email" id="email" name="email" class="border p-2 rounded focus:outline-red-500"
                            required><br>
                    </div>
                    <input type="submit" value="Reset"
                        class="w-full bg-red-600 text-white text-xl px-2 py-1 rounded focus:outline-red-500">
                </form>
            </div>
        </div>
    </section>
</body>

</html>
