<?php
include("login_checker.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating Quiz</title>
    <link rel="stylesheet" href="..\node_modules\@picocss\pico\css\pico.min.css">
    <link rel="stylesheet" href="CreatQ.css">
    <link rel="stylesheet" href="pfp.css">
    <style>
          .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .headings {
            text-align: center;
            margin-bottom: 30px;
        }


        .grid div {
            display: flex;
            justify-content: center;
        }


        details {
            margin-bottom: 20px;
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
        <a href="SignUp.php" class="secondary">Sign Out</a>
      </li>
            </ul>
          </details>
        </li>
    </ul>
    <!-- Theme Changer -->
  </nav>
  <!-- Navigation -->

<article>
    <main class="container">  
        <div class="headings" >
            <h1>Types of quiz</h1>
            <p>Currently there are 3 types of options. WIP</p>
        </div>
    <div class="grid">
        <div>
            <a href="create/multiplechoice.php"><button class="secondary" id="color1">Multiple Choice</button></a>
        </div>
        <div>
            <a href="create/Identification.php"><button class="secondary" id="color2">Identification</button></a>
        </div>
        <div>
            <a href="create/truefalse.php"><button class="secondary" id="color3">True or False</button></a>
        </div>
    </div>
</main>
</article>
    <div class="container">
        <h1>How to</h1>
        <details>
            <summary class="secondary">How to create a quizzes?</summary>
            <p>Step 1: Name your online test.<br>
Step 2: Enter your questions.<br>
Step 3: Set-up the answers.<br>
Step 4: Format the questions<br>
Step 5: Publish and share the test.</p>
        </details>
</body>
</html>
<script src="..\minimal-theme-switcher.js"></script>