<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['uid'])) {
    // Redirect the user to main.php
    header("Location: site/main.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = strtolower($_POST['username']);
    $password = $_POST['password'];

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

    // Prepare and execute the query to retrieve the user
    $query = "SELECT * FROM user_accounts WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // User exists, verify password
        $user = $result->fetch_assoc();
        
        if ($password === $user['password']) {
            // Password is correct, set session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // Check if the user is an admin
            if ($user['user_type'] === 'admin') {
                $_SESSION['is_admin'] = true;
            } else {
                $_SESSION['is_admin'] = false;
            }

            // Retrieve UID from the user_accounts table
            $query2 = "SELECT UID FROM user_accounts WHERE username = ?";
            $stmt2 = $conn->prepare($query2);
            $stmt2->bind_param('s', $username);
            $stmt2->execute();
            $stmt2->bind_result($uid);

            if ($stmt2->fetch()) {
                $_SESSION['uid'] = $uid;
            }
            $stmt2->close();

    
            // Redirect the user to main.php
            header("Location: site/main.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
    

    $conn->close();
}

function getProfilePicture() {
    // Retrieve the profile picture URL from the session or database

    // Replace this with your own logic to retrieve the URL dynamically
    if (isset($_SESSION['profile_picture'])) {
        return $_SESSION['profile_picture'];
    } else {
        return "../dafault.png";
    }
}
?>


<!doctype html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="node_modules/@picocss/pico/css/pico.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Log In</title>
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
                <h2>Please Log in to continue</h2>
            </hgroup>
        </section>
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="grid">
                    <label for="username">
                        Username
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </label>
                </div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <!-- Button -->
                <button type="submit">Log In</button>

                <div>
                    <a href="site/SignUp.php" role="button" class="secondary">Click here if you do not have an account</a>
                </div>
                <?php if (isset($error)): ?>
                    <div><?php echo $error; ?></div>
                <?php endif; ?>
            </form>
        </div>
    </article>
    <script src="minimal-theme-switcher.js"></script>
</body>

</html>
