<?php
session_start();
if (!isset($_SESSION['user']) && !isset($_COOKIE['user'])) {
    header("Location: index.php");
    exit();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : unserialize($_COOKIE['user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1><?php echo ucfirst($user['role']); ?> Dashboard</h1>
    <p>Welcome, <?php echo $user['email']; ?></p>
    <p>Company: <?php echo $user['company']; ?></p>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>
