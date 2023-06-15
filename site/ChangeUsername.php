<?php
session_start();

include_once 'connect.php';

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    // Redirect the user to the login page
    header("Location: ../login.php");
    exit();
}

// Retrieve the current and new username from the session and form submission
$currentUsername = $_SESSION['username'];
$newUsername = $_POST['newUsername'];

// Check if the new username is different from the current one
if ($newUsername !== $currentUsername) {
    // Validate the new username (you can add additional validation rules)
    if (strlen($newUsername) >= 4 && strlen($newUsername) <= 20) {
        // Check if the new username is available
        $query = "SELECT * FROM user_accounts WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $newUsername);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // Update the username in the database
            $query = "UPDATE user_accounts SET username = ? WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss', $newUsername, $currentUsername);
            $stmt->execute();
            $stmt->close();

            // Update the username in the session
            $_SESSION['username'] = $newUsername;

            // Redirect the user back to the profile page
            header("Location: Profile.php");
            exit();
        }
    }
}

// If the new username is invalid or already taken, redirect back to the profile page
header("Location: Profile.php");
exit();
?>
