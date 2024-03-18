<?php
include "..\connection.php";
include "..\\functions\header.php";
session_start();

// Current timestamp in unix format
$currentTimestamp = time();
$today = date('Y-m-d');

// Checks if user has a lesson already
if (isset($_SESSION['logged_in'])) {
    $user_id = $_SESSION["id"];
    $lessons = mysqli_query($conn, "SELECT * FROM lessons WHERE user_id = '$user_id'");
    // If it hasn't happened yet
    if (mysqli_num_rows($lessons) > 0) {
        // Checks if lesson has happened and removes it if it has
        $lessons = mysqli_fetch_array($lessons);
        $lesson_date = $lessons['lesson_date'];
        if ($today > $lesson_date) {
            mysqli_query($conn, "DELETE FROM lessons WHERE user_id = '$user_id'");
        } else {
            $lesson_exists = 'You already have a lesson booked';
        }
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user input date and time
    $userDateTime = $_POST['datetime'];

    // Convert user input into a Unix timestamp
    $userTimestamp = strtotime($userDateTime);

    // Get the current timestamp
    $currentTimestamp = time();

    // Compare user timestamp with current timestamp
    if ($userTimestamp < $currentTimestamp) {
        // If user's timestamp is before the current timestamp, display an error
        echo '<script language="javascript">';
        echo 'alert("Your date cannot be in the past, please try again");';
        echo '</script>';
    } else {
        // Complete the lesson
        mysqli_query($conn, "INSERT INTO lessons (user_id, lesson_date) VALUES ('$user_id','$userDateTime')");
        echo "Your lesson has been created successfully";
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
    <title>Bean And Brew</title>
</head>

<body>
    <?php navbar() ?>
    <div class="bookingMessage">
        <?php
        if (isset($lesson_exists)) {
            echo ('<h2>You already have a lesson booked,<br>
            It is booked for ' . $lesson_date . '.</h2>');
        } else {
            echo '<h1>Book a Lesson</h1>
        <form method="POST" style="margin-top: 10%;">
            <label for="userDate" style="padding-left: 10%; color: #606C38; font-size: 2rem;">Pick a date and time<br></label>
            <input type="datetime-local" style="color: #606C38; margin-left: 10%;" name="datetime" required id="userDate" value="' . $today . '" min="'.$today.'" max="2025-1-1">
            <button type="submit" name="submit" class="lesson-confirm">Confirm Lesson</button>
        </form>';
        }
        ?>
    </div>
</body>

</html>