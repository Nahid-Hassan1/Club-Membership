<?php
session_start();
include '../model/s_dbconnect.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../control/s_login.php");
    exit;
}

$username = $_SESSION['username'];
$sql = "SELECT shop_name, owner_name, business_type FROM sellers WHERE BINARY username = '$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="s_dashboard.css">
</head>
<body>

<div class="sidebar">
    <h2>Dashboard</h2>
    
    <a href="s_profile.php">My Profile</a>
    <a href="s_editprofile.php">Edit Profile</a>
    <a href="../control/s_logout.php">Logout</a>
</div>

<div class="main-content">
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    
    <p>This is your seller dashboard home page.</p>
    <ul>
        <li>📦 Manage your shop info</li>
        <li>📄 View your profile</li>
        <li>✏️ Edit your business details</li>
        <li>🚪 Logout securely</li>
    </ul>
    
    <p>More features can be added here, like:</p>
    <ul>
        <li>📈 Analytics (e.g. sales, traffic)</li>
        <li>🛒 Order management</li>
        <li>💬 Customer messages</li>
    </ul>
</div>

</body>
</html>
