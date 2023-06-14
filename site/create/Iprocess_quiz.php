<?php
// Establish a database connection
include('connect.php');

// Process the quiz form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $questions = $_POST['question'];
    $answers = $_POST['answer'];
  
    // Store the quiz in the Quizzes table
    $insertQuizQuery = "INSERT INTO quizzes (title, description) VALUES ('$title', '$description')";
    mysqli_query($conn, $insertQuizQuery);
    $quizId = mysqli_insert_id($conn);
  
    // Store each question and its answers in the Questions and Answers tables
    for ($i = 0; $i < count($questions); $i++) {
      $question = mysqli_real_escape_string($conn, $questions[$i]);
      $answer = mysqli_real_escape_string($conn, $answers[$i]);
  
      $insertQuestionQuery = "INSERT INTO iquestions (quiz_id, question) VALUES ($quizId, '$question')";
      mysqli_query($conn, $insertQuestionQuery);
      $questionId = mysqli_insert_id($conn);
  
      $insertAnswerQuery = "INSERT INTO ianswers (question_id, answer) VALUES ($questionId, '$answer')";
      mysqli_query($conn, $insertAnswerQuery);
    }

  
    // Close the database connection
    mysqli_close($conn);

    header("Location: ../success.php");
  }
  ?>