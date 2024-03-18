<?php
include '..\connection.php';
// Destroys all session variables and relocates user to sign in page
session_start();
session_unset();
session_destroy();
header('Location: ../screens/login.php');
exit;