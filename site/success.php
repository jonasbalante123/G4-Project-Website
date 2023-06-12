<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz Created Successfully</title>
  <link rel="stylesheet" href="..\node_modules\@picocss\pico\css\pico.min.css">
  <link rel="stylesheet" href="Identification.css">
  <link rel="stylesheet" href="..\pfp.css">
</head>
<body>
  <!-- Navigation -->
  <nav class="container-fluid">
    <ul>
      <li><strong><a href="..\main.php" class="contrast">Quiz Master</a></strong></li>
    </ul>
    <!-- Menu -->
    <ul>
      <li>
        <details role="list" dir="rtl">
          <summary aria-haspopup="listbox" role="link" class="secondary">Menu</summary>
          <ul role="listbox">
            <li><a href="..\CreatQ.php">Create Quiz</a></li>
            <li><a href="ViewQ.php">View Quizzes</a></li>
            <li><a href="">Users</a></li>
            <li><a href="..\AboutUs.php">About Us</a></li>
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
              <img src="https://cdn.discordapp.com/attachments/1107703701864448113/1108021799863730307/Heart_Detailed_2.png" width="34" height="34">
            </a>
          </summary>
          <ul role="listbox">
            <li>
              <a href="Profile.html" class="secondary">Profile</a>
            </li>
            <li>
              <a href="../settings.html" class="secondary">Settings</a>
            </li>
            <li>
              <a href="../SignUp.php" class="secondary">Sign Out</a>
            </li>
          </ul>
        </details>
      </li>
    </ul>
  </nav>

  <div class="container">
    <h1>Quiz Created Successfully</h1>
    <p>Your quiz has been successfully created and saved in the database.</p>
    <p>Thank you for creating the quiz!</p>
    <p><a href="main.php">Go back to the main page</a></p>
  </div>

  <script src="..\..\minimal-theme-switcher.js"></script>
</body>
</html>
