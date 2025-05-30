<?php
session_start();

include "../phpfiles/db.php";

if (!isset($_SESSION['client_id'])) {
    header("Location: login.php");
    exit();
}

$db = new Database();
$client = $db->getClientDetails();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($client['name']) ?>!</h2>
    <h3>Your Information:</h3>
    <p><strong>Number:</strong> <?= htmlspecialchars($client['number']) ?></p>
    <p><strong>Clubs:</strong> <?= htmlspecialchars($client['clubs']) ?></p>
    <p><strong>Membership:</strong> <?= htmlspecialchars($client['membership']) ?></p>
    <p><strong>Feedback:</strong> <?= htmlspecialchars($client['feedback']) ?></p>

    <br>
    <a href="updatehtml.php"><button>Update Information</button></a>
    <a href="deletehtml.php"><button>Delete Account</button></a>
    <a href="logout.php"><button>Logout</button></a>
</body>
</html>
