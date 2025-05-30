<?php
include "../phpfiles/phpform.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Club Registration</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <h2>Club Registration Form</h2>
    <form method="post">
        <label>Name:
            <input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>">
        </label>
        <br><?= $nameError ?? '' ?><br>

        <label>Password:
            <input type="password" name="password">
        </label>
        <br><?= $passwordError ?? '' ?><br>

        <label>Number:
            <input type="text" name="number" value="<?= htmlspecialchars($number ?? '') ?>">
        </label>
        <br><?= $numberError ?? '' ?><br>

        <label>Clubs:</label><br>
        <label><input type="checkbox" name="clubs[]" value="Science Club">Science Club</label><br>
        <label><input type="checkbox" name="clubs[]" value="Arts Club">Arts Club</label><br>
        <label><input type="checkbox" name="clubs[]" value="Music Club">Music Club</label><br>
        <label><input type="checkbox" name="clubs[]" value="Sports Club">Sports Club</label><br>
        <br><?= $clubError ?? '' ?><br>

        <label>Membership:
            <select name="membership">
                <option value="Normal">Normal</option>
                <option value="Vip">Vip</option>
                <option value="Premium">Premium</option>
            </select>
        </label>
        <br><?= $membershipError ?? '' ?><br>

        <label>Feedback:
            <textarea name="feedback"><?= htmlspecialchars($feedback ?? '') ?></textarea>
        </label>
        <br><?= $feedbackError ?? '' ?><br>

        <input type="submit" value="Register">

        <a href="login.php">Already registered? Login here</a>
    </form>
    
    
</body>
</html>