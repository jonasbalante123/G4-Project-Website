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
    $query = "SELECT * FROM mquizzes WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $quizId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('Quiz not found');
    }

    $quiz = $result->fetch_assoc();

    // Retrieve questions and options
    $query = "SELECT q.id AS question_id, q.question_text, o.option_text, a.answer_text
              FROM mquestions q
              INNER JOIN moptions o ON q.id = o.question_id
              INNER JOIN manswers a ON q.id = a.question_id
              WHERE q.quiz_id = ?
              ORDER BY q.id";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $quizId);
    $stmt->execute();
    $result = $stmt->get_result();

    $questions = array();
    while ($row = $result->fetch_assoc()) {
        $questionId = $row['question_id'];

        if (!isset($questions[$questionId])) {
            $questions[$questionId] = array(
                'id' => $questionId,
                'question_text' => $row['question_text'],
                'options' => array(),
                'answer' => $row['answer_text']
            );
        }

        $questions[$questionId]['options'][] = array(
            'question_id' => $questionId,
            'option_text' => $row['option_text']
        );
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
                $correctAnswer = $question['answer'];

                if (isset($submittedAnswers[$questionId])) {
                    $submittedAnswer = $submittedAnswers[$questionId];

                    if ($submittedAnswer === $correctAnswer) {
                        $score++;
                    }

                    $answers[$questionId] = [
                        'submitted' => $submittedAnswer,
                        'correct' => $correctAnswer
                    ];
                }
            }
        }

        // Store the quiz score in the database
        if (isset($_SESSION['uid'])) {
            $userId = $_SESSION['uid'];
            $quizType = 'm';
            $completionDate = date('Y-m-d H:i:s');

            $query = "INSERT INTO quiz_scores (user_id, quiz_id, quiz_type, score, completion_date) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('iisis', $userId, $quizId, $quizType, $score, $completionDate);
            $stmt->execute();
            $stmt->close();
        }
    }
}

$conn->close();
?>

<!-- Rest of the HTML code -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Multiple Choice Quiz</title>
    <link rel="stylesheet" href="../node_modules/@picocss/pico/css/pico.min.css">
    <link rel="stylesheet" href="view_quiz_MC.css">
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
        <br>
        <h3><?php echo $question['question_text']; ?></h3>
        <?php
            $shuffledOptions = $question['options'];
            $correctAnswer = $question['answer'];
            $shuffledOptions[] = $correctAnswer;
            shuffle($shuffledOptions);

            foreach ($shuffledOptions as $index => $option) {
                $optionText = is_array($option) ? $option['option_text'] : $option;
                echo '<input required type="radio" name="answers[' . $question['id'] . ']" id="option_' . $question['id'] . '_' . $index . '" value="' . $optionText . '"> <label for="option_' . $question['id'] . '_' . $index . '">' . $optionText . '</label><br>';
            }
        ?>
    <?php endforeach; ?>
    <br>
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
                        $correctAnswer = $answers[$questionId]['correct'];
                    ?>
                    <tr>
                        <td><?php echo $question['question_text']; ?></td>
                        <td><?php echo $submittedAnswer; ?></td>
                        <td><?php echo $correctAnswer; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>
