<?php
checkSessionStart();

function checkSessionStart() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="pfp.css">
</head>

<body>
    <nav class="container-fluid">
        <ul>
            <li><strong><a href="main.php" class="contrast">Quiz Master</a></strong></li>
        </ul>
        <!-- Menu -->
        <ul>
        <ul>
    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
        <li>
            <details role="list" dir="rtl">
                <summary aria-haspopup="listbox" role="link" class="secondary">Admin</summary>
                <ul role="listbox">
                    <li><a href="ManageA.php">Manage Accounts</a></li>
                    <li><a href="ManageQ.php">Manage Quizzes</a></li>
                </ul>
            </details>
        </li>
    <?php endif; ?>
            <li>
                <details role="list" dir="rtl">
                    <summary aria-haspopup="listbox" role="link" class="secondary">Menu</summary>
                    <ul role="listbox">
                        <li><a href="CreatQ.php">Create Quiz</a></li>
                        <li><a href="ViewQ.php">View Quizzes</a></li>
                        <li><a href="currentuser.php">Current Users</a></li>
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
            <li>
  <details role="list" dir="rtl">
    <summary aria-haspopup="listbox" role="link" class="secondary">
      <a href="Profile.php" class="profileImg">
        <img src="<?php echo getProfilePicture(); ?>" width="34" height="34">
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
        <a href="logout.php" class="secondary">Sign Out</a>
      </li>
    </ul>
  </details>
</li>

                    </ul>
                </details>
            </li>
        </ul>
    </nav>
</body>
<script src="../minimal-theme-switcher.js"></script>
</html>

<?php
function getProfilePicture() {
    // Retrieve the profile picture URL from the session or database

    // Replace this with your own logic to retrieve the URL dynamically
    if (isset($_SESSION['uid'])) {
        $userId = $_SESSION['uid'];

        // Retrieve the profile picture URL from the database
        // Modify the following code based on your database structure
        $host = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $database = 'quiz_db';

        $conn = new mysqli($host, $dbUsername, $dbPassword, $database);
        if ($conn->connect_error) {
            die('Database connection error: ' . $conn->connect_error);
        }

        $sql = "SELECT profile_picture FROM user_accounts WHERE uid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $stmt->bind_result($profile_picture); // corrected variable name here
        $stmt->fetch();
        $stmt->close();

        $conn->close();

        // Check if a profile picture URL was found
        if ($profile_picture) { // corrected variable name here
            return $profile_picture; // corrected variable name here
        }
    }

    // Fallback to the default profile picture URL
    return "../dafault.png";
}
?>