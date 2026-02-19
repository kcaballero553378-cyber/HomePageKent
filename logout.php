<?php
session_start();

session_unset();
session_destroy();

/* delete cookie */
setcookie("user", "", time() - 3600, "/");

header("Location: kent.php");
exit();
