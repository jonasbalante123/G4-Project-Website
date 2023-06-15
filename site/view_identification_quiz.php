<?php
// Assuming you have a MySQL database connection
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$database = 'quiz_db';

// Create a database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $database);
if ($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
}

// Retrieve the identification quizzes
$query = "SELECT * FROM quizzes";
$result = $conn->query($query);

if (!$result) {
    die('Error: ' . $conn->error);
}

$quizzes = $result->fetch_all(MYSQLI_ASSOC);

// Close the database connection
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View True/False Quiz</title>
    <link rel="stylesheet" href="../node_modules/@picocss/pico/css/pico.min.css">
    <link rel="stylesheet" href="view_true_false_quiz.css">
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
          <li><a href="ViewQ.php">View Quizes</a></li>
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
    <div class="container">
        <h1>Identification Quizzes</h1>
        <table>
            <thead>
                <tr>
                    <th>Quiz Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($quizzes as $quiz): ?>
                    <tr>
                        <td><?php echo $quiz['title']; ?></td>
                        <td><?php echo $quiz['description']; ?></td>
                        <td>
                            <a href="view_quiz_i.php?id=<?php echo $quiz['id']; ?>">Take Quiz</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
