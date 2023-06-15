<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="..\node_modules\@picocss\pico\css\pico.min.css">
    <link rel="stylesheet" href="AboutUs.css">
    <link rel="stylesheet" href="pfp.css">
</head>

<body>

    <!-- Navigation -->

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
    <!-- Menu Tab -->
    
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
    
    <!--  <a href="#" class="secondary profileImg"> 
                <img src="https://cdn.discordapp.com/attachments/1107703701864448113/1108021799863730307/Heart_Detailed_2.png" width="34" height="34" alt="">
                </a>-->
          <li>
            <details role="list" dir="rtl">
              <summary aria-haspopup="listbox" role="link"><a href="#" class="secondary profileImg">
                <img src="https://cdn.discordapp.com/attachments/1107703701864448113/1108021799863730307/Heart_Detailed_2.png" width="34" height="34">
                </a>
                </summary>
              <ul role="listbox">
        <li>
          <a href="Profile.html" class="secondary">Profile</a>
        </li>
        <li>
          <a href="#settings" class="secondary">Settings</a>
        </li>
        <li>
          <a href="SignUp.php
          " class="secondary">Sign Out</a>
        </li>
              </ul>
            </details>
          </li>
      </ul>
      <!-- Theme Changer -->
    </nav>
    <!-- Navigation -->

<main class="container-fluid">
    <h1>Group 4 Members</h1>

    <figure>
        <table role="grid">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Contract</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Jonas Balante</td>
              <td>Discord JJonasB#8495</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Sam Leonard Barber</td>
              <td>Unknown</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Samantha Udaundo</td>
              <td>Unknown</td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>Mark Manzano</td>
                <td>Unknown</td>
              </tr>
              <tr>
                <th scope="row">5</th>
                <td>Kriestal Montaño</td>
                <td>Unknown</td>
              </tr>
              <tr>
                <th scope="row">6</th>
                <td>John David Poquiz</td>
                <td>Unknown</td>
              </tr>
              <tr>
                <th scope="row">7</th>
                <td>Princess Fernandez Nolasco</td>
                <td>Unknown</td>
              </tr>
              <tr>
                <th scope="row">8</th>
                <td>Alamuddin, Sitti Alhambra</td>
                <td>Unknown</td>
              </tr>
          </tbody>
        </table>
      </figure>
      <div class="container">
        <details>
            <summary>According to Jonas</summary>
            <blockquote>
                I got tired of dealing with css. And rather than dealing with it like a total chad.
                I learned the "easier" css. Search for "utility-first CSS framework" and you'll see
                What I meant.
                <footer>-JJonasB</footer>
            </blockquote>
          </details>
          <hgroup>
            <h1>Note</h1>
            <h2>JJonasB and Jonas are <strong>NOT</strong> the same entity</h2>
          </hgroup>
      </div>
</main>

</body>

<script src="index.js"></script>
<script src="..\minimal-theme-switcher.js"></script>