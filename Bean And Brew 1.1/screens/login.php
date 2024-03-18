<?php
include "..\connection.php";
include "..\\functions\header.php";
include "..\\functions\sanitize.php";
include "..\\functions\\form.php";
session_start();

$email = "";
$name = "";
$password = "";
$emailErr = $nameErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // email validation
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
    // name validation
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
    }
    // password validation
    $password = test_input($_POST["password"]);

    // Check if user account already exists
    $sql = "SELECT * FROM users WHERE email = '$email' AND name = '$name'";
    $result = mysqli_query($conn, $sql);

    // Will only create variables if the query isn't empty to avoid errors
    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_array($result);
        $user_email = $result['email'];
        $user_name = $result['name'];
        $user_id = $result['id'];
        $user_pass = $result['password'];
    }
    else {
        exit('That account does not exist, please try again or sign up');
    }

    // If user already has an account
    if ($email = $user_email && $name = $user_name && password_verify($password, $user_pass)) {
        $_SESSION['logged_in'] = 'logged in';
        $_SESSION['user_email'] = $user_email;
        $_SESSION['id'] = $user_id;
        header('Location: home.php');
    } // If the account doesn't exist 
    else {
        exit('That account does not exist, please try again or sign up');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="..\css\styles.css">
    <title>Bean And Brew</title>
</head>

<body class="p-0 m-0 border-0 bd-example m-0 border-0" style="overflow: hidden">
    <?php navbar() ?>
    <h1 style="margin-left: 5%; margin-top: 2%; color: #606C38;">Sign In</h1>
    <?php form() ?>
    </form>
    <a href="sign-up.php" style="color: #606C38; margin-left: 5%;">Not a member? Sign up here</a>
</body>

</html>