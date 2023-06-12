<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    // Redirect the user to the login page
    header("Location: ..\login.php");
    exit();
}

// Retrieve the username and email from the session
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
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

<!-- Navigation -->

<!-- Header -->

<header class="container-fluid">
  <article>
    <div>
      <h1 class="text-animation">Welcome <?php echo ucfirst($_SESSION['username']); ?> To the website</h1>
      <p>To get started click the menu above!</p>
    </div>
  </article>
</header>
<!-- Header -->


<!-- Main -->
<div class="container-fluid glitched-text">
<article>Welcome to Quiz Master, the ultimate destination for quiz enthusiasts. With Quiz Master, you can test your knowledge, create your own quizzes, and explore a wide range of exciting quizzes created by other users.</article>
</div>
<!-- Main End-->

</body>

<script src="index.js"></script>
<script src="../minimal-theme-switcher.js"></script>

</html>