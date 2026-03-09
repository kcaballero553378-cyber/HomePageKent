<?php
session_start();
if(!isset($_SESSION['user_id'])){
header("Location: login.php");
}
?>

<h2>Research Management Dashboard</h2>

<a href="create.php">Add Research</a>
<a href="read.php">View Research</a>
<a href="logout.php">Logout</a>