<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the quiz details
    $quizTitle = $_POST['quiz_title'];
    $quizDescription = $_POST['quiz_description'];

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "quiz_db";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the quiz details into the database
    $sql = "INSERT INTO quizzes (title, description) VALUES ('$quizTitle', '$quizDescription')";
    $conn->query($sql);

    // Get the ID of the inserted quiz
    $quizId = $conn->insert_id;

    // Get the questions and options
    $questions = $_POST['questions'];
    $options = $_POST['options'];
    $correctOptions = $_POST['correct_options'];

    // Insert the questions and options into the database
    for ($i = 0; $i < count($questions); $i++) {
        $question = $questions[$i];
        $option1 = $options[$i][0];
        $option2 = $options[$i][1];
        $option3 = $options[$i][2];
        $option4 = $options[$i][3];
        $correctOption = $correctOptions[$i];

        $sql = "INSERT INTO questions (quiz_id, question, option1, option2, option3, option4, correct_option) 
                VALUES ('$quizId', '$question', '$option1', '$option2', '$option3', '$option4', '$correctOption')";
        $conn->query($sql);
    }

    // Close the database connection
    $conn->close();

    // Redirect back to the multiplechoice.php page with success message
    header("Location: ..\..\site\create\multiplechoice.php?success=1");
    exit();
} else {
    // Redirect to the multiplechoice.php page
    header("Location: ..\..\site\create\multiplechoice.php");
    exit();
}
?>
