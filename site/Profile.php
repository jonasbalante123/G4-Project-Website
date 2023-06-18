<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="..\node_modules\@picocss\pico\css\pico.min.css">
</head>

<body>
    <?php include "nav.php"?>

    <div class="container">
    <h1>Profile</h1>

    <h2>User Information</h2>
    <p>Username: <?php echo $_SESSION['username']; ?></p>
    <p>Email: <?php echo $_SESSION['email']; ?></p>

    <h2>Quiz History</h2>
    <?php
    // Assuming you have the necessary credentials for your database connection
    $host = 'localhost'; // Replace with your database host
    $username = 'root'; // Replace with your database username
    $password = ''; // Replace with your database password
    $dbName = 'quiz_db'; // Replace with your database name

    // Establish a database connection
    $connection = mysqli_connect($host, $username, $password, $dbName);

    // Check if the connection was successful
    if (!$connection) {
        die('Database connection failed: ' . mysqli_connect_error());
    }

    $userId = $_SESSION['uid']; // User ID from the session

    // Fetch quiz history from the database
    $query = "SELECT `id`, `user_id`, `quiz_id`, `quiz_type`, `score`, `completion_date` FROM `quiz_scores` WHERE `user_id` = $userId";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Display quiz history in a table
        echo '<table>';
        echo '<tr><th>Quiz</th><th>Score</th><th>Completion Date</th></tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            $quizId = $row['quiz_id'];
            $score = $row['score'];
            $completionDate = $row['completion_date'];

            // Retrieve quiz name based on the quiz type
            $quizType = $row['quiz_type'];
            $quizName = '';

            if ($quizType == 'tf') {
                // True/False quiz
                $quizQuery = "SELECT `title` FROM `tfquizzes` WHERE `id` = $quizId";
                $quizResult = mysqli_query($connection, $quizQuery);

                if ($quizResult && mysqli_num_rows($quizResult) > 0) {
                    $quizRow = mysqli_fetch_assoc($quizResult);
                    $quizName = $quizRow['title'];
                }
            } elseif ($quizType == 'm') {
                // Multiple-choice quiz
                $quizQuery = "SELECT `title` FROM `quizzes` WHERE `id` = $quizId";
                $quizResult = mysqli_query($connection, $quizQuery);

                if ($quizResult && mysqli_num_rows($quizResult) > 0) {
                    $quizRow = mysqli_fetch_assoc($quizResult);
                    $quizName = $quizRow['title'];
                }
            } elseif ($quizType == 'i') {
                // Interactive quiz
                $quizQuery = "SELECT `title` FROM `mquizzes` WHERE `id` = $quizId";
                $quizResult = mysqli_query($connection, $quizQuery);

                if ($quizResult && mysqli_num_rows($quizResult) > 0) {
                    $quizRow = mysqli_fetch_assoc($quizResult);
                    $quizName = $quizRow['title'];
                }
            }

            if (!empty($quizName)) {
                echo '<tr>';
                echo '<td>' . $quizName . '</td>';
                echo '<td>' . $score . '</td>';
                echo '<td>' . $completionDate . '</td>';
                echo '</tr>';
            }
        }

        echo '</table>';
    } else {
        echo 'No quiz history found.';
    }

    // Close the database connection
    mysqli_close($connection);
    ?>
</div>
</body>

</html>
