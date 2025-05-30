<?php
require_once "db.php";

$numberError = $clubError = $membershipError = "";
$number = $clubs = $membership = "";
$client = [];

$db = new Database();
$client = $db->getClientDetails();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    
    if (empty($_POST["number"]) || !is_numeric($_POST["number"])) {
        $numberError = "Valid number is required.";
        $valid = false;
    } else {
        $number = $_POST["number"];
    }

   
    if (empty($_POST["clubs"])) {
        $clubError = "Select at least one club.";
        $valid = false;
    } else {
        $clubs = $_POST["clubs"];
    }

    
    if (empty($_POST["membership"])) {
        $membershipError = "Select a membership type.";
        $valid = false;
    } else {
        $membership = $_POST["membership"];
    }

    if ($valid) {
        $db->updateClientInfo($number, $clubs, $membership);
        $db->closeConnection();
        header("Location: dashboard.php");
        exit();
    }
}
