<?php
require_once "db.php";

$name = $password = "";
$nameError = $passwordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? '';
    $password = $_POST["password"] ?? '';

    if (empty($name) || empty($password)) {
        $nameError = "Both fields are required.";
    } else {
        $db = new Database();
        $success = $db->loginClient($name, $password);
        $db->closeConnection();

        if ($success) {
            header("Location: ../WebtecFiles/dashboard.php");
            exit();
        } else {
            $nameError = "Invalid name or password.";
        }
    }
}
?>
