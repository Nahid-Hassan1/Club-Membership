<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Membership Registration</title>
    <link rel="stylesheet" href="s_registration.css?v=<?php echo time(); ?>">
    
</head>
<body>

    <h2>Seller Membership Registration Form</h2>
    <form action="s_registration_success.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <table border="1" cellpadding="10">
            <tr>
                <td><label for="shop_name">Shop Name:</label></td>
                <td>
                    <input type="text" id="shop_name" name="shop_name">
                    <div id="shop_name_error" class="error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="owner_name">Owner Name:</label></td>
                <td>
                    <input type="text" id="owner_name" name="owner_name">
                    <div id="owner_name_error" class="error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="business_type">Business Type:</label></td>
                <td>
                    <select id="business_type" name="business_type">
                        <option value="none">None</option>
                        <option value="food and beverage">Food & Beverage</option>
                        <option value="electronics store">Electronics Store</option>
                        <option value="sneakers">Sneakers</option>
                        <option value="clothing">Clothing</option>
                        <option value="accessories">Accessories</option>
                    </select>
                    <div id="business_type_error" class="error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="license">Upload Business License:</label></td>
                <td>
                    <input type="file" id="license" name="license" accept=".pdf,.jpg,.png">
                    <div id="license_error" class="error"></div>
                </td>
            </tr>

            <tr>
                <td><label for="contact">Contact Number:</label></td>
                <td>
                    <input type="tel" id="contact" name="contact" pattern="[0-9]{11}">
                    <div id="contact_error" class="error"></div>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit">Register as Seller</button>
                </td>
            </tr>
        </table>
    </form>

    <script src="s_registration_validation.js?v=<?php echo time(); ?>"></script>


</body>
</html>
