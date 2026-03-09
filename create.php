<?php
session_start();

require 'database.php';



if($_SERVER["REQUEST_METHOD"] == "POST"){

$title = $_POST['title'];
$author = $_POST['author'];
$category = $_POST['category'];
$year = $_POST['year'];

if(empty($title) || empty($author) || empty($category) || empty($year)){
    echo "All fields required";
} else {

$stmt = $pdo->prepare("INSERT INTO researches(title,author,category,year) VALUES (?,?,?,?)");
$stmt->execute([$title,$author,$category,$year]);

header("Location: read.php");
exit(); // IMPORTANT
}
}
?>

<h2>Add Research</h2>

<form method="POST">

<input type="text" name="title" placeholder="Research Title" required><br><br>

<input type="text" name="author" placeholder="Author" required><br><br>

<input type="text" name="category" placeholder="Category" required><br><br>

<input type="number" name="year" placeholder="Year" required><br><br>

<button type="submit">Add Research</button>

</form>