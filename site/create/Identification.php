<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Creating Quizzes</title>
  <link rel="stylesheet" href="..\..\node_modules\@picocss\pico\css\pico.min.css">
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
            <li><a href="..\ViewQ.php">View Quizzes</a></li>
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
    <form action="..\connect.php" method="post">
      <div class="row">
        <label for="title">Quiz Title:</label>
        <input type="text" name="title" id="title" required>
      </div>
      
      <div class="row">
        <label for="description">Quiz Description:</label>
        <textarea name="description" id="description" rows="4" cols="50"></textarea>
      </div>
      
      <h3>Questions</h3>
      
      <div id="questions">
        <div class="question">
          <label for="question1">Question 1:</label>
          <input type="text" name="question[]" required><br>
                  
          <label for="answer1">Answer 1:</label>
          <input type="text" name="answer[]" required><br>
        </div>
      </div>
      
      <button type="button" onclick="addQuestion()">Add Question</button><br><br>
      <input type="submit" value="Save Quiz">
    </form>
    <script>
      let questionCount = 1;

      function addQuestion() {
        questionCount++;

        const questionsDiv = document.getElementById('questions');

        const questionDiv = document.createElement('div');
        questionDiv.className = 'question';

        const questionLabel = document.createElement('label');
        questionLabel.htmlFor = `question${questionCount}`;
        questionLabel.textContent = `Question ${questionCount}:`;

        const questionInput = document.createElement('input');
        questionInput.type = 'text';
        questionInput.name = 'question[]';
        questionInput.required = true;

        const answerLabel = document.createElement('label');
        answerLabel.htmlFor = `answer${questionCount}`;
        answerLabel.textContent = `Answer ${questionCount}:`;

        const answerInput = document.createElement('input');
        answerInput.type = 'text';
        answerInput.name = 'answer[]';
        answerInput.required = true;

        questionDiv.appendChild(questionLabel);
        questionDiv.appendChild(questionInput);
        questionDiv.appendChild(document.createElement('br'));
        questionDiv.appendChild(answerLabel);
        questionDiv.appendChild(answerInput);

        questionsDiv.appendChild(questionDiv);
      }
    </script>
  </div>

  <script src="..\..\minimal-theme-switcher.js"></script>
</body>
</html>