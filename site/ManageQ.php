<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Include the database connection file
require_once "connect.php";


// Fetch all quizzes without duplicates
function getAllQuizzes()
{
    global $conn;

    $query = "SELECT DISTINCT id, title, description FROM tfquizzes";
    $result = $conn->query($query);

    $quizzes = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quiz = array(
                'quiz_id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description']
            );

            $quizzes[] = $quiz;
        }
    }

    $query = "SELECT DISTINCT id, title, description FROM quizzes";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quiz = array(
                'quiz_id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description']
            );

            $quizzes[] = $quiz;
        }
    }

    $query = "SELECT DISTINCT id, title, description FROM mquizzes";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quiz = array(
                'quiz_id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description']
            );

            $quizzes[] = $quiz;
        }
    }

    // Remove duplicate quizzes
    $quizzes = array_map("unserialize", array_unique(array_map("serialize", $quizzes)));

    return $quizzes;
}



// Delete a quiz
function deleteQuiz($quizId)
{
    global $conn;

    $query = "DELETE FROM quizzes WHERE quiz_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $quizId);
    $stmt->execute();
    $stmt->close();
}

// Handle delete quiz action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_quiz'])) {
    $quizId = $_POST['delete_quiz'];
    deleteQuiz($quizId);
    header("Location: ManageQ.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Quizzes</title>
    <link rel="stylesheet" href="../node_modules/@picocss/pico/css/pico.min.css">
    <link rel="stylesheet" href="pfp.css">
</head>

<body>
    <?php include 'nav.php'; ?>

    <section class="container">
        <h1>Manage Quizzes</h1>

        <table>
            <thead>
                <tr>
                    <th>Quiz ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $quizzes = getAllQuizzes();
                foreach ($quizzes as $quiz):
                ?>
                    <tr>
                        <td><?php echo $quiz['quiz_id']; ?></td>
                        <td><?php echo $quiz['title']; ?></td>
                        <td><?php echo $quiz['description']; ?></td>
                        <td>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="delete_quiz" value="<?php echo $quiz['quiz_id']; ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>

</html>
