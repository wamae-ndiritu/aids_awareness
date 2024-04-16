<?php

session_start();
// Get user information from session
$user_id = $_SESSION["user_id"];
?>

<nav class="w-full flex items-center justify-between bg-red-500 px-4 py-2 md:px-16">
    <a href="index.php" class="flex gap-3 items-center">
        <img src="images/hiv-awareness-ribbon.jpeg" alt="logo" class="h-16 object-cover">
        <h2 class="text-3xl text-white font-semibold my-auto">knowHIV</h2>
    </a>
    <ul class="flex gap-3 list-none text-white">
        <li>
            <a href="index.php#about">About</a>
        </li>
        <li>
            <a href="community.php">Community</a>
        </li>
        <li>
            <a href="index.php#join-our-community">Joining Our Community</a>
        </li>
        <li><a href="index.php#call-to-action">Tips</a></li>
        <?php
        if ($user_id){
             echo "<li><a href='logout.php'
                class='bg-white text-red-600 px-4 py-2 rounded hover:bg-gray-900 hover:text-white'>Logout</a></li>";    
        }else{
            echo "<li><a href='register.php'
                class='bg-white text-red-600 px-4 py-2 rounded hover:bg-gray-900 hover:text-white'>Sign Up</a></li>
        <li><a href='login.php' class='bg-white text-red-600 px-4 py-2 rounded hover:bg-gray-900 hover:text-white'>Sign
                In</a></li>";
        }
        ?>
        <li></li>
    </ul>
</nav>