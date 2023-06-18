<?php
session_start();

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

// Retrieve the quiz details
if (isset($_GET['id'])) {
    $quizId = $_GET['id'];

    // Prepare and execute the query to get the quiz from the database
    $query = "SELECT * FROM quizzes WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $quizId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('Quiz not found');
    }

    $quiz = $result->fetch_assoc();

    // Retrieve the quiz questions
    $query = "SELECT * FROM iquestions WHERE quiz_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $quizId);
    $stmt->execute();
    $questions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} else {
    die('Invalid quiz ID');
}

// Process the quiz submission
$score = 0;
$answers = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the quiz submission
    if (!empty($_POST['answers'])) {
        $submittedAnswers = $_POST['answers'];

        foreach ($questions as $question) {
            $questionId = $question['id'];
            $correctAnswer = getCorrectAnswer($questionId, $conn);

            if (isset($submittedAnswers[$questionId])) {
                $submittedAnswer = $submittedAnswers[$questionId];

                if (strcasecmp($submittedAnswer, $correctAnswer) === 0) {
                    $score++;
                }

                $answers[$questionId] = [
                    'submitted' => $submittedAnswer,
                    'correct' => $correctAnswer
                ];
            }
        }

        // Store the quiz score in the database
        if (isset($_SESSION['uid'])) {
            $userId = $_SESSION['uid'];
            $quizType = 'i'; // Change this according to the quiz type
            $completionDate = date('Y-m-d H:i:s');

            $query = "INSERT INTO quiz_scores (user_id, quiz_id, quiz_type, score, completion_date) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            if (!$stmt) {
                die('Error in preparing the statement: ' . $conn->error);
            }

            // Bind the parameters
            $stmt->bind_param('iisis', $userId, $quizId, $quizType, $score, $completionDate);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Scroll down to see your score!";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }
}

// Function to fetch the correct answer for a question from the ianswers table
function getCorrectAnswer($questionId, $conn) {
    $query = "SELECT answer FROM ianswers WHERE question_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $questionId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return 'N/A';
    }

    $row = $result->fetch_assoc();
    return $row['answer'];
}

// Close the database connection
$conn->close();
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Identification Quiz</title>
    <link rel="stylesheet" href="../node_modules/@picocss/pico/css/pico.min.css">
    <link rel="stylesheet" href="view_quiz_i.css">
    <link rel="stylesheet" href="pfp.css">
</head>

<body>
<?php include "nav.php"?>

    <div class="container">
        <hgroup>
            <h1><?php echo $quiz['title']; ?></h1>
            <p><?php echo $quiz['description']; ?></p>
        </hgroup>

        <form action="" method="post">
            <h3>Questions:</h3>
            <?php foreach ($questions as $question): ?>
                <h3><?php echo $question['question']; ?></h3>
                <input type="text" name="answers[<?php echo $question['id']; ?>]" required>
                <br><br>
            <?php endforeach; ?>

            <button type="submit">Submit Quiz</button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <h2>Quiz Results</h2>
            <p>Total Questions: <?php echo count($questions); ?></p>
            <p>Correct Answers: <?php echo $score; ?></p>
            <p>Incorrect Answers: <?php echo count($questions) - $score; ?></p>

            <h3>Question-wise Results:</h3>
            <table>
                <tr>
                    <th>Question</th>
                    <th>Your Answer</th>
                    <th>Correct Answer</th>
                </tr>
                <?php foreach ($questions as $question): ?>
                    <?php
                    $questionId = $question['id'];
                    $submittedAnswer = isset($answers[$questionId]['submitted']) ? $answers[$questionId]['submitted'] : 'Not answered';
                    $correctAnswer = isset($answers[$questionId]['correct']) ? $answers[$questionId]['correct'] : 'N/A';
                    ?>
                    <tr>
                        <td><?php echo $question['question']; ?></td>
                        <td><?php echo $submittedAnswer; ?></td>
                        <td><?php echo $correctAnswer; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>
