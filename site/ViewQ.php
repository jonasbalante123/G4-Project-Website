<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Quizzes</title>
    <link rel="stylesheet" href="..\node_modules\@picocss\pico\css\pico.min.css">
    <link rel="stylesheet" href="pfp.css">
    <link rel="stylesheet" href="ViewQ.css">
</head>
<body>
  <?php include "nav.php"?>

    <div class="container">
        <h2>View Quizzes</h2>

        <div class="quiz-buttons">
            <button class="quiz-button color1" onclick="viewQuiz('True/False Quiz')">True/False Quiz</button>
            <button class="quiz-button color2" onclick="viewQuiz('Multiple Choice Quiz')">Multiple Choice Quiz</button>
            <button class="quiz-button color3" onclick="viewQuiz('Short Answer Quiz')">Identification Quiz</button>
        </div>
    </div>

    <script>
        function viewQuiz(quizType) {
            // Redirect to the corresponding quiz page based on the quiz type
            if (quizType === 'True/False Quiz') {
                window.location.href = 'view_true_false_quiz.php';
            } else if (quizType === 'Multiple Choice Quiz') {
                window.location.href = 'view_multiple_choice_quiz.php';
            } else if (quizType === 'Short Answer Quiz') {
                window.location.href = 'view_identification_quiz.php';
            }
        }
    </script>
</body>
</html>