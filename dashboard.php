<?php
session_start();

// Guard: must be logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Initialize research projects in session if not yet existing
if (!isset($_SESSION['projects'])) {
    $_SESSION['projects'] = [];
}

$errors = [];

// ── HANDLE FORM SUBMIT ──
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $title      = $_POST['title'];
    $budget     = $_POST['budget'];
    $research_area = $_POST['research_area'];

    if (empty($title)) {
        $errors[] = "Error: Research project title is required.";
    }

    if (empty($budget)) {
        $errors[] = "Error: Budget is required.";
    } elseif (!is_numeric($budget) || $budget <= 0) {
        $errors[] = "Error: Budget must be a valid positive number.";
    }

    if (empty($research_area)) {
        $errors[] = "Error: Research area is required.";
    }

    // If no errors, add project to session and redirect to avoid resubmission
    if (empty($errors)) {
        $_SESSION['projects'][] = [
            'title'         => $title,
            'budget'        => $budget,
            'research_area' => $research_area,
        ];

        // Redirect to prevent form resubmission on page refresh
        header("Location: dashboard.php");
        exit();
    }
}

// ── HANDLE DELETE ──
if (isset($_GET['delete'])) {
    $index = (int) $_GET['delete'];
    if (isset($_SESSION['projects'][$index])) {
        array_splice($_SESSION['projects'], $index, 1);
    }
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Research Management System</title>
</head>
<body>

<h2>Research Management System</h2>

<p>
    Logged in as: <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>
    &nbsp;|&nbsp;
    <?php
    if (isset($_COOKIE["username"])) {
        echo "Cookie: " . htmlspecialchars($_COOKIE["username"]);
    } else {
        echo "Cookie not found!";
    }
    ?>
    &nbsp;|&nbsp;
    <a href="logout.php">Logout</a>
</p>

<hr>

<h3>Add Research Project</h3>
<form method="POST" action="">
    Research Title: <input type="text" name="title" value=""><br><br>
    Budget (in PHP): <input type="number" name="budget" value=""><br><br>
    Research Area: <input type="text" name="research_area" value=""><br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
foreach ($errors as $e) {
    echo "<p style='color:red;'>" . $e . "</p>";
}
?>

<hr>

<h3>Saved Research Projects (<?php echo count($_SESSION['projects']); ?>)</h3>

<?php if (empty($_SESSION['projects'])): ?>
    <p>No research projects yet.</p>
<?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Budget (PHP)</th>
            <th>Research Area</th>
            <th>Action</th>
        </tr>
        <?php foreach ($_SESSION['projects'] as $i => $project): ?>
        <tr>
            <td><?php echo $i + 1; ?></td>
            <td><?php echo htmlspecialchars($project['title']); ?></td>
            <td><?php echo htmlspecialchars($project['budget']); ?></td>
            <td><?php echo htmlspecialchars($project['research_area']); ?></td>
            <td><a href="?delete=<?php echo $i; ?>" onclick="return confirm('Delete this research project?')">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>