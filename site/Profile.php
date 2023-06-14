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
    $password = "SELECT `password` from `user_accounts`"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="..\node_modules\@picocss\pico\css\pico.min.css">
    <link rel="stylesheet" href="pfp.css">
</head>
<body>
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
          <li><a href="">View Quizes</a></li>
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
</nav>
<main class="container">
    <!-- THE ONE I COPY AND PASTED-->

    <p>Your Username</p>
    <?php 
    echo $username .' <a href="#">Edit?</a>'
    ?> <br><br>
    <p>password</p>
    <?php 
    echo $password .' <a href="#">Edit?</a>'
    ?>
    <p>Making a img that can be change and will take effect on the whole site jsut on the session
        <br> But for now this works
    </p>
</main>
</body>
</html>
<script src=""></script>