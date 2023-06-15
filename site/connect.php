<?php
$host = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $database = 'quiz_db';

    // Create a database connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $database);
    if ($conn->connect_error) {
        die('Database connection error: ' . $conn->connect_error);
    }
    ?>