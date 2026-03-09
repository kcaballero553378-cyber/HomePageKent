<?php
require 'database.php'; // Make sure database.php is in the same folder

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check for empty fields
    if(empty($name) || empty($email) || empty($_POST['password'])){
        $error = "All fields are required";
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);

        if($stmt->rowCount() > 0){
            $error = "Email already registered. Please login.";
        } else {
            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO users(name,email,password) VALUES (?,?,?)");
            $stmt->execute([$name,$email,$password]);

            // Redirect to login page
            header("Location: login.php");
            exit();
        }
    }
}
?>

<h2>Register</h2>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login here</a></p>