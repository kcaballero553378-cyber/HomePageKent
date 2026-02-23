<!DOCTYPE html>
<html>
<head>
  <title>Research Management System</title>
</head>
<body>

<h2>Research Management System</h2>

<?php
// ✅ GET SUPERGLOBAL DISPLAY
if (isset($_GET["source"])) {
    echo "<p><strong>GET Data:</strong> source = " . $_GET["source"] . "</p>";
}
?>

<form method="POST">
  Research Title: <input type="text" name="title"><br><br>
  Author: <input type="text" name="author"><br><br>
  Category: <input type="text" name="category"><br><br>
  Status:
  <select name="status">
    <option value="">Select</option>
    <option value="Pending">Pending</option>
    <option value="Approved">Approved</option>
  </select><br><br>

  <button type="submit">Submit</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ✅ VALIDATION
    if (empty($_POST["title"]) || empty($_POST["author"])) {
        echo "<p style='color:red;'>Title and Author are required.</p>";
    } else {
        $title    = htmlspecialchars($_POST['title']);
        $author   = htmlspecialchars($_POST['author']);
        $category = htmlspecialchars($_POST['category']);
        $status   = htmlspecialchars($_POST['status']);

        echo "<h3>POST Data Received:</h3>";
        echo "Title: $title <br>";
        echo "Author: $author <br>";
        echo "Category: $category <br>";
        echo "Status: $status <br>";
    }
}
?>

</body>
</html>