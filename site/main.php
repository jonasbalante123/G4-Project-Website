<?php
include("login_checker.php");

// Retrieve the username and email from the session
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="..\node_modules\@picocss\pico\css\pico.min.css">
    <link rel="stylesheet" href="pfp.css">
</head>

<body>

<?php include "nav.php"?>

<!-- Header -->

<header class="container-fluid">
  <article>
    <div>
      <h1 class="text-animation">Welcome <?php echo ucfirst($_SESSION['username']); ?> To the website</h1>
      <p>To get started click the menu above!</p>
    </div>
  </article>
</header>
<!-- Header -->


<!-- Main -->
<div class="container-fluid glitched-text">
<article>Welcome to Quiz Master, the ultimate destination for quiz enthusiasts. With Quiz Master, you can test your knowledge, create your own quizzes, and explore a wide range of exciting quizzes created by other users.</article>
</div>
<!-- Main End-->

</body>

<script src="index.js"></script>
<script src="../minimal-theme-switcher.js"></script>

</html>