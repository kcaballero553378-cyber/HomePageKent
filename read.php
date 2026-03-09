<?php
require 'database.php'; 

$stmt=$pdo->query("SELECT * FROM researches");
?>

<table border="1">
<tr>
<th>Title</th>
<th>Author</th>
<th>Category</th>
<th>Year</th>
<th>Action</th>
</tr>

<?php while($row=$stmt->fetch()): ?>

<tr>
<td><?= $row['title'] ?></td>
<td><?= $row['author'] ?></td>
<td><?= $row['category'] ?></td>
<td><?= $row['year'] ?></td>

<td>
<a href="update.php?id=<?= $row['id']?>">Edit</a>
<a href="delete.php?id=<?= $row['id']?>"
onclick="return confirm('Delete this record?')">
Delete
</a>
</td>

</tr>

<?php endwhile; ?>
</table>