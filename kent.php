<?php
session_start();

/* If already logged in, go to dashboard */
if (isset($_SESSION['logged_in'])) {
    header("Location: kentoy.php");
    exit();
}

/* Handle login */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    /* Simple demo account */
    if ($username === "admin" && $password === "1234") {

        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        /* Cookie valid for 1 day */
        setcookie("user", $username, time() + 86400, "/");

        header("Location: kentoy.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>

</body>
</html>
