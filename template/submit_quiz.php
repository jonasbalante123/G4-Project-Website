<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $quizName = $_POST['quiz_name'];
  $quizType = $_POST['quiz_type'];

  // Store the quiz data in the database using SQL
  $servername = "localhost";
  $username = "your_username";
  $password = "your_password";
  $dbname = "your_database_name";

  // Create a connection to the database
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Insert the quiz data into the database
  $sql = "INSERT INTO quizzes (quiz_name, quiz_type) VALUES ('$quizName', '$quizType')";

  if ($conn->query($sql) === TRUE) {
    $quizId = $conn->insert_id;

    // Insert the quiz questions and options into the database
    if ($quizType === 'multiple-choice') {
      $question = $_POST['question'];
      $options = $_POST['options'];
      $optionArr = explode(",", $options);

      // Insert the question into the database
      $sql = "INSERT INTO questions (quiz_id, question) VALUES ('$quizId', '$question')";
      if ($conn->query($sql) === TRUE) {
        $questionId = $conn->insert_id;

        // Insert the options into the database
        foreach ($optionArr as $option) {
          $sql = "INSERT INTO options (question_id, option_text) VALUES ('$questionId', '$option')";
          $conn->query($sql);
        }

        echo "Quiz created successfully!";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } elseif ($quizType === 'identification') {
      $question = $_POST['question'];
      $trueAnswer = $_POST['true_answer'];

      // Insert the question into the database
      $sql = "INSERT INTO questions (quiz_id, question) VALUES ('$quizId', '$question')";
      if ($conn->query($sql) === TRUE) {
        $questionId = $conn->insert_id;

        // Insert the true answer into the database
        $sql = "INSERT INTO identification_answers (question_id, true_answer) VALUES ('$questionId', '$trueAnswer')";
        $conn->query($sql);

        echo "Quiz created successfully!";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } elseif ($quizType === 'true-false') {
      $question = $_POST['question'];
      $trueAnswer = strtolower($_POST['true_answer']); // Convert to lowercase for case-insensitive comparison

      // Insert the question into the database
      $sql = "INSERT INTO questions (quiz_id, question) VALUES ('$quizId', '$question')";
      if ($conn->query($sql) === TRUE) {
        $questionId = $conn->insert_id;

        // Insert the true answer into the database
        $sql = "INSERT INTO true_false_answers (question_id, true_answer) VALUES ('$questionId', '$trueAnswer')";
        $conn->query($sql);

        echo "Quiz created successfully!";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Close the database connection
  $conn->close();
}
?>
