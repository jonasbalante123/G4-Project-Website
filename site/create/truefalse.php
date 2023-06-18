<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create True/False Quiz</title>
    <link rel="stylesheet" href="..\..\node_modules\@picocss\pico\css\pico.min.css">
    <link rel="stylesheet" href="..\pfp.css">
</head>
<?php include "nav.php"?>

    <div class="container">
        <form action="tfprocess_quiz.php" method="post">
            <h2>Create True/False Quiz</h2>
            <label for="quizTitle">
                Quiz Title:
                <input type="text" name="quizTitle" required>
            </label>
            <label for="quizDescription">Quiz Description:</label>
            <textarea name="quizDescription" rows="4" required></textarea>

            <h3>Questions:</h3>

            <div id="questionContainer">
                <div class="question">
                    <label for="question1">Question:</label>
                    <input type="text" name="question[]" required>

                    <label for="correctOption1">Correct Option:</label>
                    <select name="correctOption[]">
                        <option value="true">True</option>
                        <option value="false">False</option>
                    </select>
                </div>
            </div>

            <button type="button" onclick="addQuestion()">Add Question</button>

            <button type="submit">Create Quiz</button>
        </form>

        <script>
            let questionCount = 1;

            function addQuestion() {
                questionCount++;

                const questionContainer = document.getElementById("questionContainer");

                const questionDiv = document.createElement("div");
                questionDiv.classList.add("question");

                const questionLabel = document.createElement("label");
                questionLabel.textContent = "Question:";
                const questionInput = document.createElement("input");
                questionInput.type = "text";
                questionInput.name = "question[]";
                questionInput.required = true;

                const correctOptionLabel = document.createElement("label");
                correctOptionLabel.textContent = "Correct Option:";
                const correctOptionSelect = document.createElement("select");
                correctOptionSelect.name = "correctOption[]";
                const trueOption = document.createElement("option");
                trueOption.value = "true";
                trueOption.textContent = "True";
                const falseOption = document.createElement("option");
                falseOption.value = "false";
                falseOption.textContent = "False";
                correctOptionSelect.appendChild(trueOption);
                correctOptionSelect.appendChild(falseOption);

                questionDiv.appendChild(questionLabel);
                questionDiv.appendChild(questionInput);
                questionDiv.appendChild(correctOptionLabel);
                questionDiv.appendChild(correctOptionSelect);

                questionContainer.appendChild(questionDiv);
            }
        </script>
    </div>
    <script src="..\..\minimal-theme-switcher.js"></script>
</body>
</html>
