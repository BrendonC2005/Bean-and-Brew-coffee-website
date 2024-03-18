<?php
include "..\connection.php";
include "..\\functions\header.php";
session_start();

$today = date('Y-m-d');

// Checks if user has a table booking already
if (isset($_SESSION['logged_in'])) {
    $user_id = $_SESSION["id"];
    $bookings = mysqli_query($conn, "SELECT * FROM bookings WHERE user_id = '$user_id'");
    // If it hasn't happened yet
    if (mysqli_num_rows($bookings) > 0) {
        // Checks if the booking has happened and removes it if it has
        $bookings = mysqli_fetch_array($bookings);
        $booking_date = $bookings['booking_date'];
        $booking_seats = $bookings['seats'];
        $booking_location = $bookings['location'];
        // Deletes the booking and adds the seats back to the table
        if ($today > $booking_date) {
            mysqli_query($conn, "DELETE FROM bookings WHERE user_id = '$user_id'");
            $available_seats = mysqli_query($conn, "SELECT seats FROM tables WHERE location_name = '$booking_location'");
            $seats = $available_seats + $booking_seats;
            mysqli_query($conn, "UPDATE tables SET seats = '$seats' WHERE location_name = '$booking_location'");
        } else {
            $table_exists = 'You already have a restaurant booked';
        }
    }
}

// Runs when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["id"];
    $user_date = $_POST['date'];
    $user_location = $_POST['location'];
    $user_seats = $_POST['seats'];
    // Checks if user's date is in the future
    if ($today < $user_date) {
        // Checks if any seats are available
        $location_check = mysqli_query($conn, "SELECT * FROM tables WHERE location_name = '$user_location'");
        $seats_check = mysqli_fetch_array($location_check);
        // Create booking and remove booked seats
        if ($seats_check['seats'] - $user_seats > 0) {
            mysqli_query($conn, "INSERT INTO bookings (user_id, location, seats, booking_date) VALUES ('$user_id','$user_location','$user_seats','$user_date')");
            $available_seats = mysqli_query($conn, "SELECT seats FROM tables WHERE location_name = '$user_location'");
            $available_seats = $available_seats->fetch_array();
            $quantity = intval($available_seats[0]);
            $seats = $quantity - intval($user_seats);
            mysqli_query($conn, "UPDATE tables SET seats = '$seats' WHERE location_name = '$user_location'");
            echo "Your booking has been created successfully";
        } else {
            exit('Sorry, there are not enough seats available at the moment');
        }
    } else {
        exit('The date can not be from the past, please try again.');
    }
}
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
    <div class="bookingMessage">
        <?php
        if (isset($table_exists)) {
            echo ('<h2>You already have a table booked,<br>
            It is booked for ' . $booking_date . '.</h2>');
        } else {
            echo '<h2>Book a Table</h2>
        <form method="POST">
            <label for="userLocation" style="padding-top: 5%; padding-left: 10%; color: #606C38; font-size: 2rem;">Pick a Location</label>
            <select style="color: #606C38; margin-top: 5%;" name="location" required id="userLocation">
            <option value="Leeds">Leeds</option>
            <option value="Harrogate">Harrogate</option>
            <option value="Knaresborough">Knaresborough</option>
            </select>
            <br>
            <label for="userDate" style="padding-top: 5%; padding-left: 10%; color: #606C38; font-size: 2rem;">Pick a Date</label>
            <input type="date" style="color: #606C38; margin-top: 5%;" name="date" required id="userDate" value="' . $today . '" min="'.$today.'" max="2025-1-1">
            <br>
            <label for="userSeats" style="padding-top: 5%; padding-left: 10%; color: #606C38; font-size: 2rem;">How many seats do you need?</label>
            <input type="number" style="color: #606C38; margin-top: 5%;" name="seats" required id="userSeats" min="1" max="40">
            <button type="submit" name="submit" class="table-confirm">Confirm Booking</button>
        </form>';
        }
        ?>
    </div>
</body>

</html>