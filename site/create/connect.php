<?php
// Establish a database connection
$conn = mysqli_connect('localhost', 'root', '', 'quiz_db');

// Check if the connection was successful
if (!$conn) {
  die('Database connection failed: ' . mysqli_connect_error());
}
?>