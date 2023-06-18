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
<?php include "nav.php"?>

  

  <div class="container">
    <form action="Iprocess_quiz.php" method="post">
    <h2>Create Identification Quiz</h2>
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