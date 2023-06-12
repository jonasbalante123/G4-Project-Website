<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz</title>
  <link rel="stylesheet" href="..\node_modules\@picocss\pico\css\pico.min.css">
  <link rel="stylesheet" href="quiz.css">
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
              <a href="settings.html" class="secondary">Settings</a>
            </li>
            <li>
              <a href="SignUp.php" class="secondary">Sign Out</a>
            </li>
          </ul>
        </details>
      </li>
    </ul>
  </nav>

  <div class="container">
    <?php
    // Check if the id parameter is present in the URL
    if (isset($_GET['id'])) {
      $quizId = $_GET['id'];

      // Database configuration
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "quiz_db";

      // Create a connection to the database
      $conn = new mysqli($servername, $username, $password, $database);

      // Check the connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Retrieve the quiz details from the database
      $sql = "SELECT * FROM quizzes WHERE id = $quizId";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quizTitle = $row['title'];
        $quizDescription = $row['description'];

        echo "<h2>$quizTitle</h2>";
        echo "<p>$quizDescription</p>";

        // Retrieve the questions for the quiz from the database
        $sql = "SELECT * FROM questions WHERE quiz_id = $quizId";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
          // Display the questions in a form
          echo "<form method='post' action='quiz_submit.php'>";
          while ($row = $result->fetch_assoc()) {
            $questionId = $row['id'];
            $questionText = $row['question'];

            echo "<p>$questionText</p>";

            // Retrieve the options for the question from the database
            $questionOptionsSql = "SELECT * FROM options WHERE question_id = $questionId";
            $questionOptionsResult = $conn->query($questionOptionsSql);

            if ($questionOptionsResult && $questionOptionsResult->num_rows > 0) {
              while ($optionRow = $questionOptionsResult->fetch_assoc()) {
                $optionId = $optionRow['id'];
                $optionText = $optionRow['option_text'];

                echo "<input type='radio' name='answer_$questionId' value='$optionId'> $optionText<br>";
              }
            }
          }
          echo "<input type='submit' value='Submit'>";
          echo "</form>";
        } else {
          echo "<p>No questions available for this quiz.</p>";
        }
      } else {
        echo "<p>Quiz not found.</p>";
      }

      // Close the database connection
      $conn->close();
    } else {
      echo "<p>Invalid quiz ID.</p>";
    }
    ?>
  </div>

  <script src="minimal-theme-switcher.js"></script>
</body>
</html>
