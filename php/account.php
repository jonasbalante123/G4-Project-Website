<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Create a database connection
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "quiz master";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO accounts (Username, Password, Gmail) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $email);
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->affected_rows > 0) {
        echo '<script>';
        echo 'alert("Account created successfully!");';
        echo 'window.opener.location.reload();'; // Reload the parent window
        echo 'window.close();'; // Close the current window
        echo '</script>';
    } else {
        echo '<script>';
        echo 'alert("Error occurred while creating the account.");';
        echo 'window.location.href = "../signup.html";';
        echo '</script>';
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
