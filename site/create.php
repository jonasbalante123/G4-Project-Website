<?php
// Connect to your database
$pdo = new PDO('mysql:host=localhost;dbname=quiz_db', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create the table
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS questions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        quiz_id INT,
        question_text TEXT,
        option1 TEXT,
        option2 TEXT,
        option3 TEXT,
        option4 TEXT,
        correct_option INT,
        FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
    );
";

try {
    $pdo->exec($createTableQuery);
    echo "Table 'quizzes' created successfully.";
} catch (PDOException $e) {
    die("Error creating table: " . $e->getMessage());
}
?>
