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
    $query = "SELECT * FROM tfquizzes WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $quizId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('Quiz not found');
    }

    $quiz = $result->fetch_assoc();

    // Retrieve the quiz questions
    $query = "SELECT * FROM tfquestions WHERE quiz_id = ?";
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
            $correctAnswer = $question['correct_option'];

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

        // Store the quiz score in the database
        if (isset($_SESSION['uid'])) {
            $userId = $_SESSION['uid'];
            $quizType = 'tf'; // Change this according to the quiz type
            $completionDate = date('Y-m-d H:i:s');

            $query = "INSERT INTO quiz_scores (user_id, quiz_id, quiz_type, score, completion_date) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            
            // Bind the parameters
            $stmt->bind_param('iisss', $userId, $quizId, $quizType, $score, $completionDate);
            
            // Execute the statement
            $stmt->execute();
            if ($stmt->execute()) {
                echo "Scroll down to see your score!";
            } else {
                echo "Error: " . $stmt->error;
            }
            
            
        }
    }
}

// Close the database connection
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View True/False Quiz</title>
    <link rel="stylesheet" href="../node_modules/@picocss/pico/css/pico.min.css">
    <link rel="stylesheet" href="view_quiz_TF.css">
    <link rel="stylesheet" href="pfp.css">
</head>

<body>
 <!-- Navigation -->
 <nav class="container-fluid">
        <ul>
            <li><strong><a href="main.php" class="contrast">Quiz Master</a></strong></li>
        </ul>
        <!-- Menu -->
        <ul>
            <li>
                <details role="list" dir="rtl">
                    <summary aria-haspopup="listbox" role="link" class="secondary">Menu</summary>
                    <ul role="listbox">
                        <li><a href="CreatQ.php">Create Quiz</a></li>
                        <li><a href="ViewQ.php">View Quizzes</a></li>
                        <li><a href="">Users</a></li>
                        <li><a href="AboutUs.php">About Us</a></li>
                    </ul>
                </details>
            </li>

            <!-- Theme Changer -->
            <li>
                <details role="list" dir="rtl">
                    <summary aria-haspopup="listbox" role="link" class="secondary topnav">Theme</summary>
                    <ul role="listbox">
                        <li><a href="#" data-theme-switcher="light" color="black">Light</a></li>
                        <li><a href="#" data-theme-switcher="dark" color="black">Dark</a></li>
                    </ul>
                </details>
            </li>

            <!-- Profile -->
            <li>
                <details role="list" dir="rtl">
                    <summary aria-haspopup="listbox" role="link">
                        <a href="#" class="secondary profileImg">
                            <img src="https://cdn.discordapp.com/attachments/1107703701864448113/1108021799863730307/Heart_Detailed_2.png" width="34" height="34">
                        </a>
                    </summary>
                    <ul role="listbox">
                        <li>
                            <a href="Profile.html" class="secondary">Profile</a>
                        </li>
                        <li>
                            <a href="settings.html" class="secondary">Settings</a>
                        </li>
                        <li>
                            <a href="logout.php" class="secondary">Sign Out</a>
                        </li>
                    </ul>
                </details>
            </li>
        </ul>
    </nav>

<div class="container">
    <hgroup>
    <h1><?php echo $quiz['title']; ?></h1>
    <p><?php echo $quiz['description']; ?></p>
    </hgroup>

    <form action="" method="post">
    <h3>Questions:</h3>
        <?php foreach ($questions as $question): ?>
            <h3><?php echo $question['question_text']; ?></h3>
            <input type="radio" name="answers[<?php echo $question['id']; ?>]" value="true"> True
            <input type="radio" name="answers[<?php echo $question['id']; ?>]" value="false"> False
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
                    $correctAnswer = $question['correct_option'];
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
