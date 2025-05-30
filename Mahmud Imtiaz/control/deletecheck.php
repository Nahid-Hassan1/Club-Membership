<?php
require_once "db.php";

$passwordError = "";
$inputPassword = $_POST["password"] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($inputPassword)) {
        $passwordError = "Password is required.";
    } else {
        $db = new Database();
        $client = $db->getClientDetails();
        if ($client && $client["password"] === $inputPassword) {
            $db->deleteClient();
            $db->closeConnection();
            header("Location: ../WebtecFiles/login.php"); 
            exit();
        } else {
            $passwordError = "Incorrect password.";
        }
    }
}
?>