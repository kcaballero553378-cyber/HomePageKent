<?php
require 'database.php';

$id=$_GET['id'];

$stmt=$pdo->prepare("DELETE FROM researches WHERE id=?");
$stmt->execute([$id]);

header("Location:read.php");