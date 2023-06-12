<?php
// backend.php

// Include the database connection file
require_once '..\connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the form data
    $quizTitle = trim($_POST['quizTitle']);
    $quizDescription = trim($_POST['quizDescription']);
    $questions = $_POST['question'];
    $correctOptions = $_POST['correctOption'];
    $options = $_POST['options'];

    // Validate the form data (you can add more validation logic here)

    // Insert quiz details into the database
    $insertQuizQuery = $pdo->prepare("INSERT INTO identification_quizzes (title, description) VALUES (?, ?)");
    $insertQuizQuery->execute([$quizTitle, $quizDescription]);
    $quizId = $pdo->lastInsertId();

    // Insert questions and options into the database
    $insertQuestionQuery = $pdo->prepare("INSERT INTO identification_questions (quiz_id, question, correct_option) VALUES (?, ?, ?)");
    $insertOptionQuery = $pdo->prepare("INSERT INTO identification_options (question_id, option_text) VALUES (?, ?)");

    foreach ($questions as $index => $question) {
        $insertQuestionQuery->execute([$quizId, $question, $correctOptions[$index]]);
        $questionId = $pdo->lastInsertId();

        foreach ($options[$index] as $option) {
            $insertOptionQuery->execute([$questionId, $option]);
        }
    }

    // Redirect to a success page or do any other post-submission actions
    header('Location: ../success.php');
    exit();
}
