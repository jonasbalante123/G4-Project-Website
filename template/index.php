<!DOCTYPE html>
<html>
<head>
  <title>Create Quiz</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <header>
    <h1>Create Quiz</h1>
  </header>

  <main>
    <form id="create-quiz-form" action="submit_quiz.php" method="POST">
      <div id="answer-type-section">
        <h2>Answer Type:</h2>
        <label for="answer-type">Answer Type:</label>
        <select name="answer-type" id="answer-type" required>
          <option value="">Select Answer Type</option>
          <option value="multiple-choice">Multiple Choice</option>
          <option value="true-false">True or False</option>
          <option value="identification">Identification</option>
        </select>
      </div>

      <div id="quiz-info-section">
        <h2>Quiz Information:</h2>
        <label for="quiz-name">Quiz Name:</label>
        <input type="text" name="quiz-name" required>
        <label for="quiz-description">Quiz Description:</label>
        <textarea name="quiz-description" required></textarea>
      </div>

      <div id="question-section" class="hidden">
        <h2>Question:</h2>
        <label for="question">Question:</label>
        <input type="text" name="question" required>
      </div>

      <div id="options-section" class="hidden">
        <h2>Options:</h2>
        <label for="options">Options:</label>
        <input type="text" name="options" required placeholder="Enter options separated by commas">
      </div>

      <div id="true-answer-section" class="hidden">
        <h2>True Answer:</h2>
        <label for="true-answer">True Answer:</label>
        <select name="true-answer" required>
          <option value="true">True</option>
          <option value="false">False</option>
        </select>
      </div>

      <button id="add-question-btn" class="blue-btn">Add Question</button>
      <button id="remove-question-btn" class="red-btn">Remove Question</button>
      <button type="submit" id="create-quiz-btn" class="green-btn">Create Quiz</button>
    </form>
  </main>

  <script src="script.js"></script>
</body>
</html>
