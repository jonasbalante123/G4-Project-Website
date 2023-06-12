<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
    // Redirect the user to main.php
    header("Location: main.php");
    exit();
}

$usernameError = $passwordError = $emailError = $confirmPasswordError = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = strtolower($_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Validate password confirmation
    if ($password !== $confirmPassword) {
        $confirmPasswordError = "Passwords do not match";
    }

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

    // Prepare and execute the query to check if the username already exists
    $query = "SELECT * FROM user_accounts WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usernameError = "Username already exists";
    } else {
        // Prepare and execute the query to insert the new user
        $insertQuery = "INSERT INTO user_accounts (username, password, email) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param('sss', $username, $password, $email);
        if ($insertStmt->execute()) {
            // Registration successful, redirect the user to the login page
            header("Location: ..\\LogIn.php");
            exit();
        } else {
            $error = "Registration failed";
        }
    }

    $conn->close();
}
?>
<!doctype html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../node_modules/@picocss/pico/css/pico.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
</head>

<body>
    <article>
        <nav class="container-fluid">
            <ul>
                <li>
                    <a href="#Brand" class="contrast"><strong>Quiz Master</strong></a>
                </li>
            </ul>
            <li>
                <details role="list" dir="rtl">
                    <summary aria-haspopup="listbox" role="link" class="secondary">Theme</summary>
                    <ul role="listbox">
                        <li><a href="#" data-theme-switcher="light" color="black">Light</a></li>
                        <li><a href="#" data-theme-switcher="dark" color="black">Dark</a></li>
                    </ul>
                </details>
            </li>
        </nav>
        <section class="container">
            <hgroup>
                <h1>Welcome to the website</h1>
                <h2>Please Sign up to continue</h2>
            </hgroup>
        </section>
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="grid">
                    <label for="username">
                        Username
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </label>
                    <div class="error"><?php echo $usernameError; ?></div>
                </div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <div class="error"><?php echo $confirmPasswordError; ?></div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                <!-- Button -->
                <button type="submit">Sign Up</button>
                <div>
                    <a href="..\LogIn.php" role="button" class="secondary">Click here if you already have an account</a>
                </div>
            </form>
        </div>
    </article>
    <script src="../minimal-theme-switcher.js"></script>
    <script src="usernamecheck.js"></script>
</body>

</html>
