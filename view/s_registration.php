<?php
include '../model/s_dbconnect.php';


$shop_name = $owner_name = $business_type = $contact = $username = $password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["shop_name"])) {
        $errors['shop_name'] = "Shop name is required.";
    } else {
        $shop_name = trim($_POST["shop_name"]);
    }

    if (empty($_POST["owner_name"])) {
        $errors['owner_name'] = "Owner name is required.";
    } else {
        $owner_name = trim($_POST["owner_name"]);
    }

    if ($_POST["business_type"] == "none") {
        $errors['business_type'] = "Please select a business type.";
    } else {
        $business_type = $_POST["business_type"];
    }

    if (empty($_POST["contact"])) {
        $errors['contact'] = "Contact number is required.";
    } elseif (strlen($_POST["contact"]) != 11) {
        $errors['contact'] = "Contact number must be 11 digits.";
    } else {
        $contact = $_POST["contact"];
    }

    if (empty($_POST["username"])) {
        $errors['username'] = "Username is required.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($_POST["password"]) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    } else {
        $password = $_POST["password"];
    }

    // Handle license file upload
    if (!empty($_FILES['license']['name'])) {
        $license_name = $_FILES['license']['name'];
        $license_tmp = $_FILES['license']['tmp_name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($license_name);

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        if (!move_uploaded_file($license_tmp, $target_file)) {
            $errors['license'] = "Failed to upload license file.";
        }
    } else {
        $errors['license'] = "Please upload a license file.";
    }

    if (empty($errors)) {
        $shop_name = mysqli_real_escape_string($conn, $shop_name);
        $owner_name = mysqli_real_escape_string($conn, $owner_name);
        $business_type = mysqli_real_escape_string($conn, $business_type);
        $contact = mysqli_real_escape_string($conn, $contact);
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $license_name = mysqli_real_escape_string($conn, $license_name);

        $sql = "INSERT INTO sellers (shop_name, owner_name, business_type, contact, username, password, license_file) 
                VALUES ('$shop_name', '$owner_name', '$business_type', '$contact', '$username', '$password', '$license_name')";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../control/s_registration_success.php");

            exit;
        } else {
            $errors['db'] = "Database error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Membership Registration</title>
    <link rel="stylesheet" href="s_registration.css?v=<?php echo time(); ?>">
    <style>
        .error { color: red; font-size: 0.9em; }
    </style>
</head>
<body>
    <h2>Seller Membership Registration Form</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <table border="1" cellpadding="10">
            <tr>
                <td><label for="shop_name">Shop Name:</label></td>
                <td>
                    <input type="text" id="shop_name" name="shop_name" value="<?php echo htmlspecialchars($shop_name); ?>">
                    <div class="error"><?php echo $errors['shop_name'] ?? ''; ?></div>
                </td>
            </tr>

            <tr>
                <td><label for="owner_name">Owner Name:</label></td>
                <td>
                    <input type="text" id="owner_name" name="owner_name" value="<?php echo htmlspecialchars($owner_name); ?>">
                    <div class="error"><?php echo $errors['owner_name'] ?? ''; ?></div>
                </td>
            </tr>

            <tr>
                <td><label for="business_type">Business Type:</label></td>
                <td>
                    <select id="business_type" name="business_type">
                        <option value="none">None</option>
                        <option value="food and beverage" <?php if ($business_type == "food and beverage") echo "selected"; ?>>Food & Beverage</option>
                        <option value="electronics store" <?php if ($business_type == "electronics store") echo "selected"; ?>>Electronics Store</option>
                        <option value="sneakers" <?php if ($business_type == "sneakers") echo "selected"; ?>>Sneakers</option>
                        <option value="clothing" <?php if ($business_type == "clothing") echo "selected"; ?>>Clothing</option>
                        <option value="accessories" <?php if ($business_type == "accessories") echo "selected"; ?>>Accessories</option>
                    </select>
                    <div class="error"><?php echo $errors['business_type'] ?? ''; ?></div>
                </td>
            </tr>

            <tr>
                <td><label for="license">Upload Business License:</label></td>
                <td>
                    <input type="file" id="license" name="license" accept=".pdf,.jpg,.png">
                    <div class="error"><?php echo $errors['license'] ?? ''; ?></div>
                </td>
            </tr>

            <tr>
                <td><label for="contact">Contact Number:</label></td>
                <td>
                    <input type="tel" id="contact" name="contact" value="<?php echo htmlspecialchars($contact); ?>" pattern="[0-9]{11}">
                    <div class="error"><?php echo $errors['contact'] ?? ''; ?></div>
                </td>
            </tr>

            <tr>
                <td><label for="username">Username:</label></td>
                <td>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    <div class="error"><?php echo $errors['username'] ?? ''; ?></div>
                </td>
            </tr>

            <tr>
                <td><label for="password">Password:</label></td>
                <td>
                    <input type="password" id="password" name="password">
                    <div class="error"><?php echo $errors['password'] ?? ''; ?></div>
                </td>
            </tr>

            <?php if (isset($errors['db'])): ?>
            <tr>
                <td colspan="2" style="color:red; text-align:center;"><?php echo $errors['db']; ?></td>
            </tr>
            <?php endif; ?>

            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit">Register as Seller</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
