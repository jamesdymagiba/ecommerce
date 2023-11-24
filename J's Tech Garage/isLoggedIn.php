<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: profile.php"); // If the user is already logged in, redirect them to the home page.
    exit;
}
require_once "database.php";
?>