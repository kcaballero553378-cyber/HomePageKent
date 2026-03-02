<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    // Server-side validation (security only, no die())
    if ($price >= 0 && $qty >= 0) {
        $total = $price * $qty;
        $sql = "INSERT INTO transactions (item, price, qty, total) 
                VALUES (:item, :price, :qty, :total)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':item' => $item,
            ':price' => $price,
            ':qty' => $qty,
            ':total' => $total
        ]);
        header("Location: read.php");
        exit;
    }
    // If invalid, just let browser validation handle it — no error page
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Transaction</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
<div class="container">
    <h2>Add Transaction</h2>

    <form method="post">
        <label for="item">Item:</label>
        <input type="text" id="item" name="item" required><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" min="0" required><br>

        <label for="qty">Quantity:</label>
        <input type="number" id="qty" name="qty" min="0" required><br>

        <button type="submit">Save</button>
    </form>
    <a id="a1" href="read.php">View Transactions</a>
</div>
</body>
</html>