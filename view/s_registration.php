<?php

$shop_name = $owner_name = $business_type = $contact = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["shop_name"])) {
        $errors['shop_name'] = "Shop name is req.";
    } else {
        $shop_name = trim(string: $_POST["shop_name"]);
    }

    if (empty($_POST["owner_name"])) {
        $errors['owner_name'] = "Owner name is req.";
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
    

  
    if (empty($_FILES["license"]["name"])) {
        $errors['license'] = "Please upload a license file.";
    }

    

    if (empty($errors)) {
        header(header: "Location: s_registration_success.php");
        exit;
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
                    <input type="text" id="shop_name" name="shop_name" value="<?php echo $shop_name; ?>">
                    <div class="error"><?php echo isset($errors['shop_name']) ? $errors['shop_name'] : ''; ?></div>
                </td>
            </tr>

            <tr>
                <td><label for="owner_name">Owner Name:</label></td>
                <td>
                    <input type="text" id="owner_name" name="owner_name" value="<?php echo $owner_name; ?>">
                    <div class="error"><?php echo isset($errors['owner_name']) ? $errors['owner_name'] : ''; ?></div>
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
                    <div class="error"><?php echo isset($errors['business_type']) ? $errors['business_type'] : ''; ?></div>
                </td>
            </tr>

            <tr>
                <td><label for="license">Upload Business License:</label></td>
                <td>
                    <input type="file" id="license" name="license" accept=".pdf,.jpg,.png">
                    <div class="error"><?php echo isset($errors['license']) ? $errors['license'] : ''; ?></div>
                </td>
            </tr>

            <tr>
                <td><label for="contact">Contact Number:</label></td>
                <td>
                    <input type="tel" id="contact" name="contact" value="<?php echo $contact; ?>" pattern="[0-9]{11}">
                    <div class="error"><?php echo isset($errors['contact']) ? $errors['contact'] : ''; ?></div>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit">Register as Seller</button>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>
