<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Multiple Choice Quiz</title>
  <link rel="stylesheet" href="..\..\node_modules\@picocss\pico\css\pico.min.css">
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
    <h2>Create Multiple Choice Quiz</h2>
    <form method="POST" action="..\..\php\multichoice\process_quiz.php">
    <?php
if (isset($_GET['success']) && $_GET['success'] === '1') {
    echo '<p class="success-message">Quiz created successfully!</p>';
}
?>

  <div class="quiz-details">
    <label for="quiz_title">Quiz Title:</label>
    <input type="text" id="quiz_title" name="quiz_title" required>

    <label for="quiz_description">Quiz Description:</label>
    <textarea id="quiz_description" name="quiz_description" required></textarea>
  </div>

  <div class="questions-container">
    <h2>Questions:</h2>
    <div class="question">
      <label for="question1">Question 1:</label>
      <input type="text" id="question1" name="questions[]" required>

      <label for="option1_1">Option 1:</label>
      <input type="text" id="option1_1" name="options[1][]" required>

      <label for="option1_2">Option 2:</label>
      <input type="text" id="option1_2" name="options[1][]" required>

      <label for="option1_3">Option 3:</label>
      <input type="text" id="option1_3" name="options[1][]" required>

      <label for="option1_4">Option 4:</label>
      <input type="text" id="option1_4" name="options[1][]" required>

      <label for="correct_option1">Correct Option:</label>
      <select id="correct_option1" name="correct_options[]" required>
        <option value="">Select Correct Option</option>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
        <option value="4">Option 4</option>
      </select>
    </div>
  </div>

  <button type="button" id="add-question-btn">Add Question</button>
  <button type="submit">Create Quiz</button>
</form>

  </div>

  <script>
    function addQuestion() {
      var questionsContainer = document.getElementById('questions-container');
      var questionDiv = document.createElement('div');
      questionDiv.className = 'question';

      var questionLabel = document.createElement('label');
      questionLabel.textContent = 'Question:';
      var questionInput = document.createElement('input');
      questionInput.type = 'text';
      questionInput.name = 'questions[]';
      questionInput.required = true;

      var optionsLabel = document.createElement('label');
      optionsLabel.textContent = 'Options:';
      optionsLabel.innerHTML += '<br>';
      var optionInputs = [];
      for (var i = 0; i < 4; i++) {
        var optionInput = document.createElement('input');
        optionInput.type = 'text';
        optionInput.name = 'options[][${i}]';
        optionInput.required = true;
        optionInputs.push(optionInput);
      }

      var correctOptionLabel = document.createElement('label');
      correctOptionLabel.textContent = 'Correct Option:';
      var correctOptionInput = document.createElement('input');
      correctOptionInput.type = 'text';
      correctOptionInput.name = 'correctOptions[]';
      correctOptionInput.required = true;

      questionDiv.appendChild(questionLabel);
      questionDiv.appendChild(questionInput);
      questionDiv.innerHTML += '<br><br>';
      questionDiv.appendChild(optionsLabel);
      questionDiv.innerHTML += '<br>';
      for (var i = 0; i < optionInputs.length; i++) {
        questionDiv.appendChild(optionInputs[i]);
      }
      questionDiv.innerHTML += '<br><br>';
      questionDiv.appendChild(correctOptionLabel);
      questionDiv.appendChild(correctOptionInput);

      questionsContainer.appendChild(questionDiv);
    }

    function removeQuestion() {
      var questionsContainer = document.getElementById('questions-container');
      var questions = questionsContainer.getElementsByClassName('question');
      if (questions.length > 1) {
        questionsContainer.removeChild(questions[questions.length - 1]);
      }
    }
  </script>
</body>
</html>
