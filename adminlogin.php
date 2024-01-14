<html>

<head>
    <title>Admin Login</title>
</head>
<body>
    <form action="admincheck.php" method="post">
        <label for="admin_username">Admin Username:</label>
        <input type="text" id="admin_username" name="admin_username" required><br>

        <label for="admin_password">Admin Password:</label>
        <input type="password" id="admin_password" name="admin_password" required><br>

        <input type="submit" value="Admin Login">
    </form>
</body>
</html>