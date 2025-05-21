<?php
session_start();

include '../model/s_dbconnect.php';

$username = $password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, trim($_POST["username"]));
    $password = mysqli_real_escape_string($conn, trim($_POST["password"]));

    if (empty($username)) {
        $errors['username'] = "Username is required.";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    }

    if (empty($errors)) {
        // Case-sensitive username comparison
        $query = "SELECT * FROM sellers WHERE BINARY username = '$username'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // Plain text password comparison (not secure, but per your setup)
            if ($password === $user['password']) {
                $_SESSION['username'] = $user['username'];
                header("Location: ../view/s_dashboard.php");
                exit;
            } else {
                $errors['password'] = "Incorrect password.";
            }
        } else {
            $errors['username'] = "Username not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Login</title>
    <link rel="stylesheet" href="s_login.css?v=<?php echo time(); ?>">
    <style>.error { color: red; font-size: 0.9em; }</style>
</head>
<body>
    <h2>Seller Login</h2>
    <form method="post">
        <table border="1" cellpadding="10">
            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    <div class="error"><?php echo $errors['username'] ?? ''; ?></div>
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password">
                    <div class="error"><?php echo $errors['password'] ?? ''; ?></div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <button type="submit">Login</button>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">
                    Don't have an account? <a href="../view/s_registration.php">Go to Register</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
