<?php
// Assuming you have established a database connection
// Replace DB_HOST, DB_USER, DB_PASSWORD, and DB_NAME with your actual database credentials
$connection = mysqli_connect('DB_HOST', 'DB_USER', 'DB_PASSWORD', 'DB_NAME');

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the quiz title and description
    $quizTitle = $_POST['quizTitle'];
    $quizDescription = $_POST['quizDescription'];

    // Insert the quiz details into the database
    $query = "INSERT INTO quizzes (title, description) VALUES ('$quizTitle', '$quizDescription')";
    mysqli_query($connection, $query);

    // Retrieve the generated quiz ID
    $quizId = mysqli_insert_id($connection);

    // Retrieve and process the questions and correct options
    $questions = $_POST['question'];
    $correctOptions = $_POST['correctOption'];

    // Insert each question into the database
    for ($i = 0; $i < count($questions); $i++) {
        $question = $questions[$i];
        $correctOption = $correctOptions[$i];

        // Insert the question into the database
        $query = "INSERT INTO questions (quiz_id, question, correct_option) VALUES ('$quizId', '$question', '$correctOption')";
        mysqli_query($connection, $query);
    }

    // Close the database connection
    mysqli_close($connection);

    // Redirect to the success page
    header("Location: http://localhost/G4-PROJECT-WEBSITE/site/create/multiplechoice.php?success=1");
    exit;
}
?>
