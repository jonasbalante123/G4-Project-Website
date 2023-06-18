<?php
// Assuming you have the necessary credentials for your database connection
$host = 'localhost'; // Replace with your database host
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$dbName = 'quiz_db'; // Replace with your database name

// Establish a database connection
$connection = mysqli_connect($host, $username, $password, $dbName);

// Check if the connection was successful
if (!$connection) {
    die('Database connection failed: ' . mysqli_connect_error());
}

session_start(); // Assuming you are using sessions for user authentication

// Check if the user is logged in and the user ID exists in the session
if (!isset($_SESSION['uid'])) {
    // Redirect the user to the login page or display an error message
    header('Location: ../index.php');
    exit();
}

$userId = $_SESSION['uid']; // User ID from the session

// Fetch user data from the database using the logged-in user's ID
$query = "SELECT `username`, `password`, `profile_picture` FROM `user_accounts` WHERE `UID` = $userId";
$result = mysqli_query($connection, $query);

// Check if the query was successful and user data is found
if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
} else {
    // Handle the case when user data is not found
    // Redirect the user to an error page or display an error message
    die('User data not found.');
}

// Handle form submissions for username update
if (isset($_POST['new_username'])) {
    $newUsername = mysqli_real_escape_string($connection, $_POST['new_username']);

    // Update the username in the database
    $updateQuery = "UPDATE `user_accounts` SET `username` = '$newUsername' WHERE `UID` = $userId";
    $updateResult = mysqli_query($connection, $updateQuery);

    if ($updateResult) {
        // Username update successful
        // You can redirect the user to the settings page or display a success message
        header('Location: settings.php');
        exit();
    } else {
        // Username update failed
        // Handle the error appropriately
        echo 'Error updating username: ' . mysqli_error($connection);
    }
}

// Handle form submissions for password update
if (isset($_POST['new_password'])) {
    $newPassword = mysqli_real_escape_string($connection, $_POST['new_password']);

    // Update the password in the database
    $updateQuery = "UPDATE `user_accounts` SET `password` = '$newPassword' WHERE `UID` = $userId";
    $updateResult = mysqli_query($connection, $updateQuery);

    if ($updateResult) {
        // Password update successful
        // You can redirect the user to the settings page or display a success message
        header('Location: settings.php');
        exit();
    } else {
        // Password update failed
        // Handle the error appropriately
        echo 'Error updating password: ' . mysqli_error($connection);
    }
}

// Handle form submissions for profile picture update
if (isset($_FILES['new_profile_picture'])) {
    $file = $_FILES['new_profile_picture'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];

    // Move the uploaded file to a desired location
    $destination = 'uploads/' . $fileName;
    if (move_uploaded_file($fileTmpName, $destination)) {
        // Update the profile picture in the database
        $updateQuery = "UPDATE `user_accounts` SET `profile_picture` = '$destination' WHERE `UID` = $userId";
        $updateResult = mysqli_query($connection, $updateQuery);

        if ($updateResult) {
            // Profile picture update successful
            // Update the profile picture in the session
            $_SESSION['profile_picture'] = $destination;

            // You can redirect the user to the settings page or display a success message
            header('Location: settings.php');
            exit();
        } else {
            // Profile picture update failed
            // Handle the error appropriately
            echo 'Error updating profile picture: ' . mysqli_error($connection);
        }
    } else {
        // Failed to move the uploaded file
        // Handle the error appropriately
        echo 'Error uploading profile picture.';
    }
}

// Rest of the HTML and form elements for the settings page


// Rest of the HTML and form elements for the settings page
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Settings</title>
    <link rel="stylesheet" href="..\node_modules\@picocss\pico\css\pico.min.css">
</head>
<body>
<?php include "nav.php" ?>

    <div class="container">
        <h1>User Settings</h1>

        <h2>Update Username</h2>
        <form method="POST" action="settings.php">
            <div class="form-row">
                <input type="text" name="new_username" placeholder="New Username" required>
                <input type="submit" value="Update Username">
            </div>
        </form>

        <h2>Update Password</h2>
        <form method="POST" action="settings.php">
            <div class="form-row">
                <input type="password" name="new_password" placeholder="New Password" required>
                <input type="submit" value="Update Password">
            </div>
        </form>

        <h2>Update Profile Picture</h2>
        <form method="POST" action="settings.php" enctype="multipart/form-data">
            <div class="form-row">
                <input type="file" name="new_profile_picture" required>
                <input type="submit" value="Update Profile Picture">
            </div>
        </form>
    </div>
</body>
</html>



