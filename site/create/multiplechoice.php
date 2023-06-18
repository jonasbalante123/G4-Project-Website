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

// Retrieve the available multiple-choice quizzes
$query = "SELECT * FROM mquizzes";
$result = $conn->query($query);

if (!$result) {
    die('Error retrieving quizzes: ' . $conn->error);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Multiple Choice Quiz</title>
    <link rel="stylesheet" href="../../node_modules/@picocss/pico/css/pico.min.css">
    <link rel="stylesheet" href="view_true_false_quiz.css">
</head>
<body>
<?php include "nav.php"?>

<div class="container">
    <form action="mprocess_quiz.php" method="post">
    <h2>Create Multiplication Quiz</h2>
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
          
          <label for="options1">Options:</label><br>
          <input type="text" name="option[0][]" required><br>
          <input type="text" name="option[0][]" required><br>
          <input type="text" name="option[0][]" required><br>
          
          <label for="answer1">Correct Answer:</label>
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

        const optionsLabel = document.createElement('label');
        optionsLabel.htmlFor = `options${questionCount}`;
        optionsLabel.textContent = 'Options:';

        const optionsInputs = [];
        for (let i = 1; i <= 3; i++) {
        const optionInput = document.createElement('input');
        optionInput.type = 'text';
        optionInput.name = `option[${questionCount - 1}][]`; // Corrected indexing
        optionInput.required = true;
        optionsInputs.push(optionInput);
       }

        const answerLabel = document.createElement('label');
        answerLabel.htmlFor = `answer${questionCount}`;
        answerLabel.textContent = 'Correct Answer:';

        const answerInput = document.createElement('input');
        answerInput.type = 'text';
        answerInput.name = 'answer[]';
        answerInput.required = true;

        questionDiv.appendChild(questionLabel);
        questionDiv.appendChild(questionInput);
        questionDiv.appendChild(document.createElement('br'));
        questionDiv.appendChild(optionsLabel);
        questionDiv.appendChild(document.createElement('br'));
        optionsInputs.forEach(optionInput => {
          questionDiv.appendChild(optionInput);
          questionDiv.appendChild(document.createElement('br'));
        });
        questionDiv.appendChild(answerLabel);
        questionDiv.appendChild(answerInput);

        questionsDiv.appendChild(questionDiv);
      }
    </script>
  </div>

</body>
</html>