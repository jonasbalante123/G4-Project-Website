<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    // Redirect the user to the login page
    header("Location: ..\index.php");
    exit();
}