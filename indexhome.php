<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration</title>
</head>
<body>
    <h1>Welcome to Course Registration</h1>
    <p><a href="register.php">Register</a></p>
    <p><a href="login.php">Login</a></p>
</body>
</html>
