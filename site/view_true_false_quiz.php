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

// Retrieve the available true/false quizzes
$query = "SELECT * FROM tfquizzes";
$result = $conn->query($query);

if (!$result) {
    die('Error retrieving quizzes: ' . $conn->error);
}

// Close the database connection
$conn->close();
?>

<!doctype html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View True/False Quiz</title>
    <link rel="stylesheet" href="../node_modules/@picocss/pico/css/pico.min.css">
    <link rel="stylesheet" href="view_true_false_quiz.css">
    <link rel="stylesheet" href="pfp.css">
</head>

<body>
<?php include "nav.php"?>
    <section class="container headings">
        <h1>View True/False Quiz</h1>
        <p>Click on a quiz to view details:</p>
    </section>

    <div class="container">
        <table class="quiz-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><a href="view_quiz_TF.php?id=<?php echo urlencode($row['id']); ?>" class="quiz-link">Take Quiz</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


</body>

</html>
