<?php
session_start();
include '../model/s_dbconnect.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../control/s_login.php");
    exit;
}

$username = $_SESSION['username'];

$sql = "SELECT shop_name, owner_name, business_type, contact FROM sellers WHERE BINARY username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    $user = ['shop_name' => '', 'owner_name' => '', 'business_type' => 'N/A', 'contact' => ''];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="s_dashboard.css"> <!-- reuse your dashboard style -->
</head>
<body>
    <div class="sidebar">
    <h2>Dashboard</h2>
    
    <a href="s_profile.php">My Profile</a>
    <a href="s_editprofile.php">Edit Profile</a>
    <a href="../control/s_logout.php">Logout</a>
</div>

    <div class="main-content">
        <h2>My Profile</h2>

        <div class="profile-section">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>Shop Name:</strong> <?php echo htmlspecialchars($user['shop_name']); ?></p>
            <p><strong>Owner Name:</strong> <?php echo htmlspecialchars($user['owner_name']); ?></p>
            <p><strong>Business Type:</strong> <?php echo htmlspecialchars($user['business_type']); ?></p>
            <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($user['contact']); ?></p>
        </div>
    </div>
</body>
</html>
