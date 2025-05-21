<?php
session_start();
include '../model/s_dbconnect.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../control/s_login.php");
    exit;
}

$username = $_SESSION['username'];
$errors = [];
$success = "";

$sql = "SELECT shop_name, owner_name, business_type, contact FROM sellers WHERE BINARY username = '$username'";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    $user = ['shop_name' => '', 'owner_name' => '', 'business_type' => 'none', 'contact' => ''];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shop_name = trim($_POST['shop_name']);
    $owner_name = trim($_POST['owner_name']);
    $business_type = $_POST['business_type'];
    $contact = trim($_POST['contact']);

    if (empty($shop_name)) $errors['shop_name'] = "Shop name is required.";
    if (empty($owner_name)) $errors['owner_name'] = "Owner name is required.";
    if ($business_type === "none") $errors['business_type'] = "Please select a business type.";
    if (empty($contact) || strlen($contact) != 11) $errors['contact'] = "Contact must be 11 digits.";

    if (empty($errors)) {
        $shop_name = mysqli_real_escape_string($conn, $shop_name);
        $owner_name = mysqli_real_escape_string($conn, $owner_name);
        $business_type = mysqli_real_escape_string($conn, $business_type);
        $contact = mysqli_real_escape_string($conn, $contact);

        $update_sql = "UPDATE sellers SET shop_name='$shop_name', owner_name='$owner_name', business_type='$business_type', contact='$contact' WHERE BINARY username='$username'";
        if (mysqli_query($conn, $update_sql)) {
            if (mysqli_affected_rows($conn) > 0) {
                $success = "Profile updated successfully.";
            }
            $user = ['shop_name' => $shop_name, 'owner_name' => $owner_name, 'business_type' => $business_type, 'contact' => $contact];
        } else {
            $errors['db'] = "Database error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Dashboard</title>
    <link rel="stylesheet" type="text/css" href="s_dashboard.css">
</head>
<body>

<div class="sidebar">
    <h2>Dashboard</h2>
    
    <a href="s_profile.php">My Profile</a>
    <a href="s_editprofile.php">Edit Profile</a>
    <a href="../control/s_logout.php">Logout</a>
</div>

<div class="main-content">
    <h2>Welcome, <?php echo htmlspecialchars($username); ?></h2>

    <?php if (!empty($success)): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post">
        <table>
            <tr>
                <td>Shop Name:</td>
                <td>
                    <input type="text" name="shop_name" value="<?php echo htmlspecialchars($user['shop_name']); ?>">
                    <div class="error"><?php echo $errors['shop_name'] ?? ''; ?></div>
                </td>
            </tr>
            <tr>
                <td>Owner Name:</td>
                <td>
                    <input type="text" name="owner_name" value="<?php echo htmlspecialchars($user['owner_name']); ?>">
                    <div class="error"><?php echo $errors['owner_name'] ?? ''; ?></div>
                </td>
            </tr>
            <tr>
                <td>Business Type:</td>
                <td>
                    <select name="business_type">
                        <option value="none" <?php if($user['business_type']=="none") echo "selected"; ?>>-- Select --</option>
                        <option value="food and beverage" <?php if($user['business_type']=="food and beverage") echo "selected"; ?>>Food & Beverage</option>
                        <option value="electronics store" <?php if($user['business_type']=="electronics store") echo "selected"; ?>>Electronics Store</option>
                        <option value="sneakers" <?php if($user['business_type']=="sneakers") echo "selected"; ?>>Sneakers</option>
                        <option value="clothing" <?php if($user['business_type']=="clothing") echo "selected"; ?>>Clothing</option>
                        <option value="accessories" <?php if($user['business_type']=="accessories") echo "selected"; ?>>Accessories</option>
                    </select>
                    <div class="error"><?php echo $errors['business_type'] ?? ''; ?></div>
                </td>
            </tr>
            <tr>
                <td>Contact Number:</td>
                <td>
                    <input type="tel" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>">
                    <div class="error"><?php echo $errors['contact'] ?? ''; ?></div>
                </td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Update Profile</button></td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
