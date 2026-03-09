<?php
session_start(); // Session protection if you use login

require 'database.php';

// Check if ID is provided
if(!isset($_GET['id'])){
    die("ID not provided");
}

$id = $_GET['id'];

// Fetch the existing record
$stmt = $pdo->prepare("SELECT * FROM researches WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

// If no record found
if(!$data){
    die("Record not found");
}

// Process form submission
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $year = $_POST['year'];

    // Simple validation
    if(empty($title) || empty($author) || empty($category) || empty($year)){
        $error = "All fields are required";
    } else {
        $stmt = $pdo->prepare("UPDATE researches SET title=?, author=?, category=?, year=? WHERE id=?");
        $stmt->execute([$title, $author, $category, $year, $id]);

        // Redirect back to read.php
        header("Location: read.php");
        exit(); // Important!
    }
}
?>

<h2>Update Research</h2>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    <input type="text" name="title" value="<?= htmlspecialchars($data['title']) ?>" required><br><br>
    <input type="text" name="author" value="<?= htmlspecialchars($data['author']) ?>" required><br><br>
    <input type="text" name="category" value="<?= htmlspecialchars($data['category']) ?>" required><br><br>
    <input type="number" name="year" value="<?= htmlspecialchars($data['year']) ?>" required><br><br>
    <button type="submit">Update</button>
</form>