<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="..\node_modules\@picocss\pico\css\pico.min.css">
    <style>


        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .profile-details {
            margin-bottom: 1rem;
        }

        .profile-details label {
            font-weight: bold;
        }

        .profile-details .edit-button {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #5f7b8c;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .profile-details .edit-button:hover {
            background-color: #43555f;
        }

        .edit-form {
            display: none;
            margin-top: 1rem;
        }

        .edit-form .input-group {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .edit-form .input-group input[type="text"],
        .edit-form .input-group input[type="password"],
        .edit-form .input-group input[type="file"] {
            flex: 1;
            padding: 0.5rem;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .edit-form .input-group button {
            background-color: #5f7b8c;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

    </style>
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
                        <li><a href="ViewQ.php">View Quizes</a></li>
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
                    <summary aria-haspopup="listbox" role="link"><a href="#" class="secondary profileImg">
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
    <main class="container">
        <div class="card">
            <h2 class="card-title">Your Profile</h2>
            <div class="profile-details">
                <label>Username:</label>
                <span><?php echo $username; ?></span>
                <button class="edit-button">Edit</button>
                <form class="edit-form" id="username-form" action="" method="post">
                    <div class="input-group">
                        <input type="text" name="new_username" placeholder="New Username" required>
                        <button type="submit">Save</button>
                    </div>
                </form>
            </div>
            <div class="profile-details">
                <label>Password:</label>
                <span><?php echo $password; ?></span>
                <button class="edit-button">Edit</button>
                <form class="edit-form" id="password-form" action="" method="post">
                    <div class="input-group">
                        <input type="password" name="new_password" placeholder="New Password" required>
                        <button type="submit">Save</button>
                    </div>
                </form>
            </div>
            <div class="profile-details">
                <label>Profile Picture:</label>
                <img src="path/to/profile_picture.jpg" alt="Profile Picture" width="100" height="100">
                <button class="edit-button">Edit</button>
                <form class="edit-form" id="profile-picture-form" action="" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <input type="file" name="profile_picture" accept="image/*" required>
                        <button type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        var editButtons = document.getElementsByClassName('edit-button');
        for (var i = 0; i < editButtons.length; i++) {
            editButtons[i].addEventListener('click', function() {
                var form = this.nextElementSibling;
                form.classList.toggle('show');
            });
        }
    </script>
</body>

</html>
