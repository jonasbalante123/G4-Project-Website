<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $questions = $_POST['question'];
  $answers = $_POST['answer'];
  $username = $_SESSION['username'];

  $host = 'localhost';
  $dbUsername = 'root';
  $dbPassword = '';
  $database = 'quiz_db';

  $conn = new mysqli($host, $dbUsername, $dbPassword, $database);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("INSERT INTO quizzes (title, description, author) VALUES (?, ?, ?)");
  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }
  $stmt->bind_param("sss", $title, $description, $username);
  if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
  }

  $quizId = $conn->insert_id;

  $stmt = $conn->prepare("INSERT INTO questions (quiz_id, question, answer) VALUES (?, ?, ?)");
  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  for ($i = 0; $i < count($questions); $i++) {
    $stmt->bind_param("iss", $quizId, $questions[$i], $answers[$i]);
    if (!$stmt->execute()) {
      die("Execute failed: " . $stmt->error);
    }
  }

  $stmt->close();
  $conn->close();

  header("Location: ../../site/success.php");
  exit();
}
?>
