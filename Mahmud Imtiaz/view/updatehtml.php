<?php
include "../phpfiles/updatecheck.php"; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Information</title>
    <link rel="stylesheet" href="update.css">
</head>
<body>
    <h2>Update Your Information</h2>

    <form method="post">
        <label>Number:
            <input type="text" name="number" value="<?= htmlspecialchars($client['number']) ?>">
        </label>
        <br><?= $numberError ?? '' ?><br>

        <label>Clubs:<br>
            <input type="checkbox" name="clubs[]" value="Science Club" <?= strpos($client['clubs'], 'Science Club') !== false ? 'checked' : '' ?>> Science Club<br>
            <input type="checkbox" name="clubs[]" value="Arts Club" <?= strpos($client['clubs'], 'Arts Club') !== false ? 'checked' : '' ?>> Arts Club<br>
            <input type="checkbox" name="clubs[]" value="Music Club" <?= strpos($client['clubs'], 'Music Club') !== false ? 'checked' : '' ?>> Music Club<br>
            <input type="checkbox" name="clubs[]" value="Sports Club" <?= strpos($client['clubs'], 'Sports Club') !== false ? 'checked' : '' ?>> Sports Club
        </label>
        <br><?= $clubError ?? '' ?><br>

        <label>Membership:
            <select name="membership">
                <option value="">Select</option>
                <option value="Normal" <?= $client['membership'] == 'Normal' ? 'selected' : '' ?>>Normal</option>
                <option value="Vip" <?= $client['membership'] == 'Vip' ? 'selected' : '' ?>>Vip</option>
                <option value="Premium" <?= $client['membership'] == 'Premium' ? 'selected' : '' ?>>Premium</option>
            </select>
        </label>
        <br><?= $membershipError ?? '' ?><br>

        <input type="submit" value="Update Information">
        <a href="dashboard.php">Return</a>

    </form>
    <br>
    
</body>
</html>
