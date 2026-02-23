<?php
session_start();

/* ✅ AUTO REDIRECT IF ALREADY LOGGED IN */
if (isset($_SESSION["logged_in"])) {
    header("Location: kentoy.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $email    = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm  = $_POST["confirm"];

    /* ✅ FORM VALIDATIONS */
    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $error = "All fields are required.";
    } elseif (strlen($username) < 4) {
        $error = "Username must be at least 4 characters.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {

        /* ✅ SESSION */
        $_SESSION["logged_in"] = true;
        $_SESSION["username"]  = $username;

        /* ✅ COOKIE */
        setcookie("user", $username, time() + (86400 * 7), "/");

        header("Location: kentoy.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login / Signup</title>
</head>
<body>

<h2>Login / Signup</h2>

<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    Username: <input type="text" name="username"><br><br>
    Email: <input type="email" name="email"><br><br>
    Password: <input type="password" name="password"><br><br>
    Confirm Password: <input type="password" name="confirm"><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>