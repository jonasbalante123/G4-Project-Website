<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$database = 'quiz_db';

$conn = new mysqli($host, $dbUsername, $dbPassword, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch True/False quizzes
$sql = "SELECT * FROM true_false_quizzes";
$result = $conn->query($sql);

$trueFalseQuizzes = array();
while ($row = $result->fetch_assoc()) {
    $trueFalseQuizzes[] = $row;
}

// Fetch Identification quizzes
$sql = "SELECT * FROM identification_quizzes";
$result = $conn->query($sql);

$identificationQuizzes = array();
while ($row = $result->fetch_assoc()) {
    $identificationQuizzes[] = $row;
}

// Fetch Multiple Choice quizzes
$sql = "SELECT * FROM multiple_choice_quizzes";
$result = $conn->query($sql);

$multipleChoiceQuizzes = array();
while ($row = $result->fetch_assoc()) {
    $multipleChoiceQuizzes[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Quizzes</title>
    <link rel="stylesheet" href="..\node_modules\@picocss\pico\css\pico.min.css">
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

</body>
</html>
