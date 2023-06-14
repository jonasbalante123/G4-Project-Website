<?php
// Assuming you have established a database connection
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $questions = $_POST['question'];
  $options = $_POST['option'];
  $answers = $_POST['answer'];

  // Insert the quiz into the 'mquizzes' table
  $sql = "INSERT INTO mquizzes (title, description) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $title, $description);
  $stmt->execute();

  // Get the ID of the inserted quiz
  $quizId = $stmt->insert_id;

  // Insert each question, options, and answer into their respective tables
  foreach ($questions as $index => $question) {
    // Insert the question into the 'mquestions' table
    $sql = "INSERT INTO mquestions (quiz_id, question_text) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $quizId, $question);
    $stmt->execute();

    // Get the ID of the inserted question
    $questionId = $stmt->insert_id;

    foreach ($options[$index] as $option) {
      // Insert each option into the 'moptions' table
      $sql = "INSERT INTO moptions (question_id, option_text) VALUES (?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("is", $questionId, $option);
      $stmt->execute();

      // Display the inserted option
      echo "Inserted option for question $index: " . $option . "<br>";
    }

    $answer = $answers[$index];

    // Insert the answer into the 'manswers' table
    $sql = "INSERT INTO manswers (question_id, answer_text) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $questionId, $answer);
    $stmt->execute();
  }

//   Redirect to a success page after the data is saved
  header("Location: ../success.php");
  exit;
}
?>
