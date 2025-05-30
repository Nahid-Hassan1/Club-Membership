<?php
require_once "db.php";

$name = $password = $number = $membership = $feedback = "";
$clubs = [];

$nameError = $passwordError = $numberError = $clubError = $membershipError = $feedbackError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    if (empty($_POST["name"])) {
        $nameError = "Name is required.";
        $valid = false;
    } else {
        $name = $_POST["name"];
    }

    if (empty($_POST["password"])) {
        $passwordError = "Password is required.";
        $valid = false;
    } else {
        $password = $_POST["password"];
    }

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

    if (empty($_POST["feedback"])) {
        $feedbackError = "Feedback is required.";
        $valid = false;
    } else {
        $feedback = $_POST["feedback"];
    }

    if ($valid) {
        $db = new Database();
        $db->registerClient($name, $password, $number, $clubs, $membership, $feedback);
        $db->closeConnection();
        header("Location: ../WebtecFiles/login.php");
        exit();
    }
}
?>