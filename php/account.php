<?php
  // Prepare and execute the query to retrieve the user
  $query = "SELECT * FROM user_accounts WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($query);

  if ($result->num_rows === 1) {
      // Authentication successful, set session variables
      $user = $result->fetch_assoc();
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];

      // Redirect the user to main.html
      header("Location: site/main.html");
      exit();
  } else {
      $error = "Invalid username or password";
  }

  $conn->close();
}
}
?>