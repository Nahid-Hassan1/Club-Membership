<?php
session_start();
include '../model/s_dbconnect.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../control/s_login.php");
    exit;
}

$username = $_SESSION['username'];
$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM sellers WHERE BINARY username = '$username'";
    if (mysqli_query($conn, $sql)) {
        session_destroy();
        header("Location: ../control/s_login.php?deleted=1");
        exit;
    } else {
        $error = "Error deleting account: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Account</title>
    <link rel="stylesheet" href="s_deleteaccount.css">
</head>
<body>

<div class="box">
    <h2>Delete My Account</h2>

    <?php if (!empty($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <button type="submit">Yes, Delete My Account</button>
    </form>

    <a class="cancel" href="../view/s_dashboard.php">Cancel and Go Back</a>
</div>

</body>
</html>
