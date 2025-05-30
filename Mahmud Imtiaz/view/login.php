<?php
include "../phpfiles/logincheck.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h2>Login Form</h2>
    <form method="post">
        <label>Name:
            <input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>">
        </label>
        <br><?= $nameError ?? '' ?><br>

        <label>Password:
            <input type="password" name="password">
        </label>
        <br><?= $passwordError ?? '' ?><br>

        <input type="submit" value="Login">
        <a href="htmlform.php">New client? Register here</a>
    </form>
    <br>
    
</body>
</html>