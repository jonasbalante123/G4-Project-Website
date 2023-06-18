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

// Retrieve the available multiple-choice quizzes
$query = "SELECT * FROM mquizzes";
$result = $conn->query($query);

if (!$result) {
    die('Error retrieving quizzes: ' . $conn->error);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Multiple Choice Quiz</title>
    <link rel="stylesheet" href="../node_modules/@picocss/pico/css/pico.min.css">
    <link rel="stylesheet" href="view_true_false_quiz.css">
    <link rel="stylesheet" href="pfp.css">
</head>
<body>
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
                        <li><a href="">Leaderboards</a></li>
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

            <li>
                <details role="list" dir="rtl">
                    <summary aria-haspopup="listbox" role="link">
                        <a href="#" class="secondary profileImg">
                            <img src="https://cdn.discordapp.com/attachments/1107703701864448113/1108021799863730307/Heart_Detailed_2.png" width="34" height="34">
                        </a>
                    </summary>
                    <ul role="listbox">
                        <li>
                            <a href="Profile.php" class="secondary">Profile</a>
                        </li>
                        <li>
                            <a href="#settings" class="secondary">Settings</a>
                        </li>
                        <li>
                            <a href="logout.php" class="secondary">Sign Out</a>
                        </li>
                    </ul>
                </details>
            </li>
        </ul>
    </nav>

    <section class="container headings">
        <h1>View Multiple Choice Quiz</h1>
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
                        <td><a href="view_quiz_MC.php?id=<?php echo urlencode($row['id']); ?>" class="quiz-link">Take Quiz</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


</body>
</html>
