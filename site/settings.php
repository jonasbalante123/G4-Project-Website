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
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            padding: 50px;
            background-color: #1f1f1f;
            border-radius: 4px;
            color: #fff;
        }

        h1 {
            margin-bottom: 20px;
            color: #fff;
        }

        form {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            align-items: center;
        }

        .form-row input[type="text"],
        .form-row input[type="password"],
        .form-row input[type="file"] {
            margin-bottom: 10px;
            width: 300px;
            margin-right: 10px;
        }

        .form-row input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            width: auto; /* Set the width to auto */
        }

        .navbar {
            background-color: #1f1f1f;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar ul {
            display: flex;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            margin-right: 10px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #fff;
            padding: 5px;
        }
    </style>
</head>
<body>
<!-- Navigation -->
<nav class="container-fluid">
    <ul>
      <li><strong><a href="main.php" class="contrast">Quiz Master</a></strong></li>
    </ul>
    <!-- Menu -->
    <ul>
      <li>
        <details role="list" dir="rtl">
          <summary aria-haspopup="listbox" role="link" class="secondary">Menu</summary>
          <ul role="listbox">
            <li><a href="CreatQ.php">Create Quiz</a></li>
            <li><a href="ViewQ.php">View Quizzes</a></li>
            <li><a href="">Users</a></li>
            <li><a href="AboutUs.php">About Us</a></li>
          </ul>
        </details>
      </li>

      <!-- Theme Changer -->
      <li>
        <details role="list" dir="rtl">
          <summary aria-haspopup="listbox" role="link" class="secondary topnav">Theme</summary>
          <ul role="listbox">
            <li><a href="#" data-theme-switcher="light" color="black">Light</a></li>
            <li><a href="#" data-theme-switcher="dark" color="black">Dark</a></li>
          </ul>
        </details>
      </li>

      <!-- Profile -->
      <li>
        <details role="list" dir="rtl">
          <summary aria-haspopup="listbox" role="link">
           <a href="#" class="secondary profileImg">
            <img src="<?php echo isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'https://cdn.discordapp.com/attachments/1107703701864448113/1108021799863730307/Heart_Detailed_2.png'; ?>" width="34" height="34">
            </a>

          </summary>
          <ul role="listbox">
            <li>
              <a href="Profile.php" class="secondary">Profile</a>
            </li>
            <li>
              <a href="settings.php" class="secondary">Settings</a>
            </li>
            <li>
              <a href="Logout.php" class="secondary">Sign Out</a>
            </li>
          </ul>
        </details>
      </li>
    </ul>
  </nav>

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



