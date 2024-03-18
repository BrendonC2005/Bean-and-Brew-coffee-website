<?php
function navbar()
{
    // Checks if user is signed in
    if (isset($_SESSION['user_email'])) {
        $email = $_SESSION['user_email'];
        echo '<div class="header">
            <img class="logo" src="..\assets\bean-and-brew-nobg.png" alt="Bean and brew logo">
            <p>You are logged in as ' . $email . '</p>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="order.php">Order Now</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="..\functions\logout.php">Sign out</a></li>
            </ul></div>';
    } // Shows if user is not signed in
    else {
        echo '<div class="header">
            <img class="logo" src="..\assets\bean-and-brew-nobg.png" alt="Bean and brew logo">
            <p>You are not signed in</p>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="login.php">Sign in</a></li>
            </ul></div>';
    }
}
