<?php
session_start();
require 'database.php'; // Make sure database.php is in the same folder

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        $error = "All fields are required";
    } else {
        // Check if email exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if($user){
            // Verify password
            if(password_verify($password, $user['password'])){
                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];

                // Redirect to dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Incorrect password";
            }
        } else {
            $error = "Email not registered";
        }
    }
}
?>

<h2>Login</h2>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>