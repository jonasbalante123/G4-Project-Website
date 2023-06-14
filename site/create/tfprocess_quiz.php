<?php
// Assuming you have established a database connection
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $quizTitle = $_POST['quizTitle'];
  $quizDescription = $_POST['quizDescription'];
  $questions = $_POST['question'];
  $correctOptions = $_POST['correctOption'];

  // Insert the quiz into the 'tfquizzes' table
  $sql = "INSERT INTO tfquizzes (title, description) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $quizTitle, $quizDescription);
  $stmt->execute();

  // Get the ID of the inserted quiz
  $quizId = $stmt->insert_id;

  // Insert each question and its correct option into the 'tfquestions' table
  foreach ($questions as $index => $question) {
    $correctOption = $correctOptions[$index];

    // Insert the question into the 'tfquestions' table
    $sql = "INSERT INTO tfquestions (quiz_id, question_text, correct_option) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $quizId, $question, $correctOption);
    $stmt->execute();

    // Get the ID of the inserted question
    $questionId = $stmt->insert_id;

    // Update the quiz_id column of the question with the correct quiz ID
    $sql = "UPDATE tfquestions SET quiz_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $quizId, $questionId);
    $stmt->execute();
  }

  // Redirect to a success page after the data is saved
  header("Location: ../success.php");
  exit;
}
?>
