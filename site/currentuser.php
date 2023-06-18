<?php
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

// Prepare and execute the query to get the usernames and the count of quizzes made by each user
$query = "SELECT u.username, COUNT(q.user_id) AS quiz_count
          FROM user_accounts u
          LEFT JOIN quiz_scores q ON u.uid = q.user_id
          GROUP BY u.username";
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        ?>
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>User Quiz Count</title>
            <link rel="stylesheet" href="../node_modules/@picocss/pico/css/pico.min.css">
            <style>
                .container {
                    max-width: 700px;
                    margin: 0 auto;
                }
                h1 {
                    font-size: 1.5rem;
                    margin-bottom: 1rem;
                }
                .user-info {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 1rem;
                    border-bottom: 1px solid #eee;
                }
                .user-info .username {
                    font-weight: bold;
                }
                .user-info .quiz-count {
                    font-size: 0.9rem;
                    color: #555;
                }
            </style>
        </head>
        <body>
        <?php
        // Include the nav.php file for navigation
        include "nav.php";
        ?>
        <div class="container">
            <h1>User Quiz Count</h1>
            <div class="user-quiz-count">
                <?php
                while ($row = $result->fetch_assoc()) {
                    $username = $row['username'];
                    $quizCount = $row['quiz_count'];
                    ?>
                    <div class="user-info">
                        <div class="username"><?php echo $username; ?></div>
                        <div class="quiz-count">Quiz Count: <?php echo $quizCount; ?></div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        </body>
        </html>
        <?php
    } else {
        echo "No results found.";
    }
} else {
    echo "Query error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
