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

  // Check if user email already exists
  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);

  // If user already has an account
  if (mysqli_num_rows($result) > 0) {
    exit('That email is already in use, please use another or sign in instead');
  } else if ($emailErr != "") {
    echo "Invalid email format";
  }
  // Creates new account entry in db
  else {
    $securePass = password_hash($password, PASSWORD_BCRYPT);
    mysqli_query(
      $conn,
      "INSERT INTO users (email, name, password) VALUES ('$email', '$name', '$securePass')"
    )
      or die("Failed to create account" . mysqli_error($conn));
    header('Location: login.php');
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
  <h1 style="margin-left: 5%; margin-top: 2%; color: #606C38;">Sign Up</h1>
  <?php form() ?>
  <a href="login.php" style="color: #606C38; margin-left: 5%;">Already a member? Sign in here</a>
</body>

</html>