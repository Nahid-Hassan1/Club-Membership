<?php
include "../phpfiles/deletecheck.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Account</title>
    <link rel="stylesheet" href="delete.css">
</head>
<body>
    <h2>Confirm Account Deletion</h2>
    <form method="post">
        <label>Enter your password to confirm:
            <input type="password" name="password">
        </label>
        <br><?= $passwordError ?? '' ?><br>

        <input type="submit" value="Delete Account">
        <a href="dashboard.php">Return</a>
    </form>
    
</body>
</html>