<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the quiz details
    $quizTitle = $_POST['quizTitle'];
    $quizDescription = $_POST['quizDescription'];

    // Insert the quiz details into the database
    $sql = "INSERT INTO quizzes (quiz_title, description) VALUES ('$quizTitle', '$quizDescription')";
    mysqli_query($conn, $sql);
    $quizId = mysqli_insert_id($conn); // Get the last inserted quiz ID

    // Insert the questions and options into the database
    if (isset($_POST['question'])) {
        for ($i = 0; $i < count($_POST['question']); $i++) {
            $question = $_POST['question'][$i];
            $correctOption = $_POST['correctOption'][$i];
            $options = $_POST['options'][$i + 1]; // Adjusting index to match question number

            // Insert the question into the database
            $sql = "INSERT INTO questions (quiz_id, question_text, correct_option) VALUES ('$quizId', '$question', '$correctOption')";
            mysqli_query($conn, $sql);
            $questionId = mysqli_insert_id($conn); // Get the last inserted question ID

            // Insert the options into the database
            foreach ($options as $option) {
                $sql = "INSERT INTO options (question_id, option_text) VALUES ('$questionId', '$option')";
                mysqli_query($conn, $sql);
            }
        }
    }

    // Redirect to a success page or perform any additional actions
    header("Location: ..\..\site\success.php");
    exit();
} else {
    // Handle invalid request
    echo "ITS AN ERROR";
    exit();
}

?>
