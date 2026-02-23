<?php
session_start();

/* ✅ BLOCK ACCESS IF NOT LOGGED IN */
if (!isset($_SESSION["logged_in"])) {
    header("Location: kent.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Dashboard</h2>

<p>
Welcome,
<strong>
<?php
echo $_SESSION["username"];
if (isset($_COOKIE["user"])) {
    echo " (cookie: " . $_COOKIE["user"] . ")";
}
?>
</strong>
</p>

<hr>

<a href="wow.php?from=dashboard">Go to Research Page (GET)</a>
<br><br>
<a href="logout.php">Logout</a>

</body>
</html>