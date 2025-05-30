<?php
session_start();
session_destroy();
header("Location: ../WebtecFiles/login.php");
exit;