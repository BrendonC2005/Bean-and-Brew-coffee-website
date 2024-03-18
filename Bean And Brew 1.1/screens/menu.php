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
    <title>Bean And Brew</title>
</head>
<body>
    <?php navbar() ?>
    <h1 style="color: #606C38; text-align: center; margin: 1%;">Our Menu Items</h1>
    <div class="grid-container">
        <div class="grid-child">Food</div>
        <div class="grid-child">Food</div>
        <div class="grid-child">Food</div>
        <div class="grid-child">Coffee</div>
        <div class="grid-child">Iced Latte</div>
        <div class="grid-child">Hot Choccy Wocky</div>
        <div class="grid-child">Cappucino</div>
        <div class="grid-child">Tea</div>
        <div class="grid-child">Espresso</div>
    </div>
    <?php
    if (isset($_SESSION['logged_in'])) {
        echo "<a class='order-button' href='order.php'>Order Now!</a>";
    }
    ?>
</body>
</html>