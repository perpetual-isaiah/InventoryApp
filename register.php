<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $company = $_POST['company'];
    $role = $_POST['role']; // Role selection

    // Validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        echo "Password must be at least 8 characters long, include 1 uppercase letter, 1 number, and 1 special character.";
        exit();
    }

    $password = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (email, password, company, role) VALUES ('$email', '$password', '$company', '$role')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='login.php'>Login Here</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h2>Register</h2>
    <form method="POST">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <input type="text" name="company" required placeholder="Company Name">
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="manager">Manager</option>
            <option value="sales">Sales</option>
        </select>
        <button type="submit">Sign Up</button>
    </form>
</div>

</body>
</html>
