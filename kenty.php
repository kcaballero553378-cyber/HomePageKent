<?php
session_start();

if (isset($_SESSION["logged_in"])) {
    header("Location: dashboard.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}