<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create True/False Quiz</title>
    <link rel="stylesheet" href="..\..\node_modules\@picocss\pico\css\pico.min.css">
    <link rel="stylesheet" href="..\pfp.css">
</head>
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
            <li><a href="..\CreatQ.php">Create Quiz</a></li>
            <li><a href="..\ViewQ.php">View Quizzes</a></li>
            <li><a href="">Users</a></li>
            <li><a href="..\AboutUs.php">About Us</a></li>
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
        <form action="..\connect.php" method="post">
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
