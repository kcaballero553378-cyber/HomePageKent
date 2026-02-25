<?php
session_start();

// Unset the username session variable to log the user out
unset($_SESSION['username']);

// Redirect to login page
header("Location: login.php");
exit();
?>