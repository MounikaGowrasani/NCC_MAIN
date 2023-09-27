<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    
    <h1>Login Page</h1>
    <form action="admin.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="uname" id="uname" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="pass" id="pass" required><br><br>
        <input type="submit" name="submit" value="submit">
    </form>
    <!-- Your admin login form can be placed here -->
</body>
</html>
