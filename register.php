<?php
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Connect to DB
    $db = new Database();
    $conn = $db->connect();

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, username, password_hash) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$full_name, $email, $phone, $username, $hashed_password]);

    echo "🎉 Registration successful. <a href='login.php'>Login here</a>";
}
?>

<h2>Register</h2>
<form method="POST">
  Full Name: <input type="text" name="full_name" required><br><br>
  Email: <input type="email" name="email" required><br><br>
  Phone: <input type="text" name="phone"><br><br>
  Username: <input type="text" name="username" required><br><br>
  Password: <input type="password" name="password" required><br><br>
  <button type="submit">Register</button>
</form>
