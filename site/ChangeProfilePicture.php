<?php
session_start();

include_once 'connect.php';

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    // Redirect the user to the login page
    header("Location: ../login.php");
    exit();
}

// Retrieve the username from the session
$username = $_SESSION['username'];

// Check if a file was uploaded
if (isset($_FILES['profilePicture'])) {
    $file = $_FILES['profilePicture'];

    // Check for errors in the uploaded file
    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = $file['name'];
        $tempFilePath = $file['tmp_name'];

        // Move the uploaded file to a permanent location
        $destination = "profile-pictures/$fileName";
        move_uploaded_file($tempFilePath, $destination);

        // Update the profile picture in the database
        $query = "UPDATE user_accounts SET profile_picture = ? WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $fileName, $username);
        $stmt->execute();
        $stmt->close();

        // Redirect the user back to the profile page
        header("Location: Profile.php");
        exit();
    }
}

// If no file was uploaded or an error occurred, redirect back to the profile page
header("Location: Profile.php");
exit();
?>
