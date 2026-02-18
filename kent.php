<!DOCTYPE html>
<html>
<head>
  <title>Research Management System</title>
</head>
<body>

<h2>Research Management System</h2>

<form method="POST" action="">
  Research Title: <input type="text" name="title"><br><br>
  Author: <input type="text" name="author"><br><br>
  Category: <input type="text" name="category"><br><br>
  Status: <input type="text" name="status"><br><br>
  <input type="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title    = htmlspecialchars($_POST['title']);
  $author   = htmlspecialchars($_POST['author']);
  $category = htmlspecialchars($_POST['category']);
  $status   = htmlspecialchars($_POST['status']);

  echo "<h3>Form Data Received (POST):</h3>";
  echo "Title: "    . $title    . "<br>";
  echo "Author: "   . $author   . "<br>";
  echo "Category: " . $category . "<br>";
  echo "Status: "   . $status   . "<br>";
}
?>

</body>
</html>