<?php
session_start();

include_once 'connect.php';

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    // Redirect the user to the login page
    header("Location: ../login.php");
    exit();
}

// Retrieve the username and email from the session
$username = $_SESSION['username'];
$email = $_SESSION['email'];

// Retrieve the user's password from the database
$query = "SELECT `password`, `profile_picture` FROM `user_accounts` WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $password = 'N/A';
    $profilePicture = 'default-profile-picture.jpg';
} else {
    $row = $result->fetch_assoc();
    $password = $row['password'];
    $profilePicture = $row['profile_picture'];
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="..\node_modules\@picocss\pico\css\pico.min.css">
    <link rel="stylesheet" href="pfp.css">
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
          <li><a href="">Leaderboards</a></li>
          <li><a href="AboutUs.php">About Us</a></li>
        </ul>
      </details>
    </li>
<!-- Menu Tab -->

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

<!--  <a href="#" class="secondary profileImg"> 
            <img src="https://cdn.discordapp.com/attachments/1107703701864448113/1108021799863730307/Heart_Detailed_2.png" width="34" height="34" alt="">
            </a>-->
      <li>
        <details role="list" dir="rtl">
          <summary aria-haspopup="listbox" role="link"><a href="#" class="secondary profileImg">
            <img src="https://cdn.discordapp.com/attachments/1107703701864448113/1108021799863730307/Heart_Detailed_2.png" width="34" height="34">
            </a>
            </summary>
          <ul role="listbox">
    <li>
      <a href="Profile.php" class="secondary">Profile</a>
    </li>
    <li>
      <a href="#settings" class="secondary">Settings</a>
    </li>
    <li>
      <a href="logout.php" class="secondary">Sign Out</a>
    </li>
          </ul>
        </details>
      </li>
  </ul>
  <!-- Theme Changer -->
</nav>

<div class="container">
  <h1>Profile</h1>
    <div class="grid">
      <p>Username:</p>  <?php echo $username; ?>
    </div>
    
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleEditForm(section) {
            const formId = section + '-form';
            const form = document.getElementById(formId);
            form.classList.toggle('show');
        }
    </script>
</body>

</html>
