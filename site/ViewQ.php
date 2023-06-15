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
    <!-- Navigation -->
    <nav class="container-fluid">
        <ul>
            <li><strong><a href="..\main.php" class="contrast">Quiz Master</a></strong></li>
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
                            <a href="..\Profile.html" class="secondary">Profile</a>
                        </li>
                        <li>
                            <a href="..\settings.html" class="secondary">Settings</a>
                        </li>
                        <li>
                            <a href="..\SignUp.php" class="secondary">Sign Out</a>
                        </li>
                    </ul>
                </details>
            </li>
        </ul>
    </nav>

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
