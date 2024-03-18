<?php
include "..\connection.php";
include "..\\functions\header.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\styles.css" media="only screen and (min-device-width: 900px)">
    <link rel="stylesheet" href="..\css\small-styles.css" media="only screen and (max-device-width: 900px)">
    <style>
        .grad {
            height: 900px;
            background: linear-gradient(rgb(254, 250, 225), rgb(96, 108, 56));
        }
    </style>
    <title>Bean And Brew</title>
</head>

<body>
    <?php navbar() ?>
    <div class="content">
        <h1>View our wonderful <br>Coffee and Food</h1>
        <a href="menu.php">Our Menu</a>
        <img class="menupic" src="..\assets\coffee-cup.png" alt="Coffee cup">
        <?php
        // Displays different messages if user is signed in or not
        if (isset($_SESSION['logged_in'])) {
            echo '<h4>Scroll down to view our booking options</h4>';
        } else {
            echo '<h4>Sign in to view our booking options</h4>';
        }
        ?>
    </div>
    <?php
    // Only displays second part of the website if a user is logged in
    if (isset($_SESSION['logged_in'])) {
        echo '<div class="content2"> 
        <div class="home-grid-container">
            <div class="home-grid-child">
                <br>Book a table at one of our locations<br>
                <a href="table-book.php" class="home-grid-button">Book a Table</a>
            </div>
            <div class="home-grid-child">
                <br>Book an online baking lesson<br>
                <a href="lesson-book.php" class="home-grid-button">Book a Lesson</a>
            </div>
        </div>
    </div>';
    }
    ?>
</body>

</html>