<?php
include "..\connection.php";
include "..\\functions\header.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST['location'];
    $drink = $_POST['drink'];
    switch ($drink) {
        case 'Coffee' || 'Tea' :
            $price = '£3.00';
        break;
        case 'Iced Latte' :
            $price = '£3.40';
        break;
        case 'Hot Choccy Wocky' :
            $price = '£3.20';
        break;
        case 'Cappucino' :
            $price = '£3.50';
        break;
        case 'Espresso' :
            $price = '£3.30';
        break;
    }
    $id = $_SESSION['id'];
    // Gets timezone used by server
    $timezone = date_default_timezone_get();
    $date = date('Y-m-d H:i:s');
    // Creates order in orders table
    mysqli_query($conn, "INSERT INTO orders (user_id, item, price, location, order_date) VALUES ('$id','$drink','$price','$location','$date')");
    echo '<div style="color: #606C38;">Your order has been created!</div>';
}

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
    <div class='order-title'>
        <h1>Create An Order</h1>
        <form class="order-form" method="POST">
            <h2>Please select a location for collection</h2>
            <input type="radio" name="location" value="Leeds" id="location1" style="margin: 3% 0% 0% 3%;" required>
            <label for="location1" style="color: #606C38; font-size: 1.5rem;">Leeds</label>
            <input type="radio" name="location" value="Knaresborough" id="location2" style="margin: 3% 0% 0% 3%;" required>
            <label for="location2" style="color: #606C38; font-size: 1.5rem;">Knaresborough</label>
            <input type="radio" name="location" value="Harrogate" id="location3" style="margin: 3% 0% 0% 3%;" required>
            <label for="location3" style="color: #606C38; font-size: 1.5rem;">Harrogate</label>
            <h2>Please select a drink from below</h2>
            <div class="drink-container">
                <div class="drink-child">
                    <input type="radio" name="drink" value="Coffee" id="drink1" required>
                    <label for="drink1" class="menu-button">Coffee<br>£3.00</label>
                </div>
                <div class="drink-child">
                    <input type="radio" name="drink" value="Iced Latte" id="drink2" required>
                    <label for="drink2" class="menu-button">Iced Latte<br>£3.40</label>
                </div>
                <div class="drink-child">
                    <input type="radio" name="drink" value="Hot Choccy Wocky" id="drink3" required>
                    <label for="drink3" class="menu-button">Hot Choccy Wocky<br>£3.20</label>
                </div>
                <div class="drink-child">
                    <input type="radio" name="drink" value="Cappucino" id="drink4" required>
                    <label for="drink4" class="menu-button">Cappucino<br>£3.50</label>
                </div>
                <div class="drink-child">
                    <input type="radio" name="drink" value="Tea" id="drink5" required>
                    <label for="drink5" class="menu-button">Tea<br>£3.00</label>
                </div>
                <div class="drink-child">
                    <input type="radio" name="drink" value="Espresso" id="drink6" required>
                    <label for="drink6" class="menu-button">Espresso<br>£3.30</label>
                </div>
            </div>
            <button type='submit' name="submit" class='order-confirm'>Confirm order</button>
        </form>
    </div>
</body>

</html>