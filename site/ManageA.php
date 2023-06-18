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

// Fetch all user accounts
function getAllUserAccounts()
{
    global $conn;

    $query = "SELECT * FROM user_accounts";
    $result = $conn->query($query);

    $accounts = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $accounts[] = $row;
        }
    }

    return $accounts;
}

// Delete a user account
function deleteUserAccount($userId)
{
    global $conn;

    $query = "DELETE FROM user_accounts WHERE UID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->close();
}

// Update a user account
function updateUserAccount($userId, $username, $password)
{
    global $conn;

    $query = "UPDATE user_accounts SET username = ?, password = ? WHERE UID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $username, $password, $userId);
    $stmt->execute();
    $stmt->close();
}

// Disable a user account
function disableUserAccount($userId)
{
    global $conn;

    $query = "UPDATE user_accounts SET disabled = 1 WHERE UID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->close();
}

// Handle account action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['account_action'])) {
    $action = $_POST['account_action'];
    $userId = $_POST['UID'];

    if ($action === 'delete') {
        deleteUserAccount($userId);
    } elseif ($action === 'disable') {
        disableUserAccount($userId);
    } elseif ($action === 'update') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        updateUserAccount($userId, $username, $password);
    }

    header("Location: ManageA.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Accounts</title>
    <link rel="stylesheet" href="../node_modules/@picocss/pico/css/pico.min.css">
    <link rel="stylesheet" href="pfp.css">
</head>

<body>
    <?php include 'nav.php'; ?>

    <section class="container">
        <h1>Manage Accounts</h1>

        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $accounts = getAllUserAccounts();
                foreach ($accounts as $account):
                ?>
                    <tr>
                        <td><?php echo $account['UID']; ?></td>
                        <td><?php echo $account['username']; ?></td>
                        <td><?php echo $account['email']; ?></td>
                        <td>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="UID" value="<?php echo $account['UID']; ?>">
                                <select name="account_action">
                                    <option value="">Select an Action</option>
                                    <option value="update">Update</option>
                                    <option value="disable">Disable</option>
                                    <option value="delete">Delete</option>
                                </select>
                                <div id="update-fields-<?php echo $account['UID']; ?>" style="display: none;">
                                    <label for="username-<?php echo $account['UID']; ?>">New Username:</label>
                                    <input type="text" name="username" id="username-<?php echo $account['UID']; ?>">
                                    <br>
                                    <label for="password-<?php echo $account['UID']; ?>">New Password:</label>
                                    <input type="password" name="password" id="password-<?php echo $account['UID']; ?>">
                                    <br>
                                </div>
                                <button type="submit">Submit</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <script>
        var updateFields = <?php echo json_encode(array_column($accounts, 'UID')); ?>;
        
        function showUpdateFields(userId) {
            var updateFieldsDiv = document.getElementById('update-fields-' + userId);
            if (updateFieldsDiv) {
                updateFieldsDiv.style.display = 'block';
            }
        }
        
        function hideUpdateFields(userId) {
            var updateFieldsDiv = document.getElementById('update-fields-' + userId);
            if (updateFieldsDiv) {
                updateFieldsDiv.style.display = 'none';
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            var selectElements = document.getElementsByName('account_action');
            if (selectElements) {
                selectElements.forEach(function(selectElement) {
                    selectElement.addEventListener('change', function() {
                        var userId = this.form.querySelector('input[name="UID"]').value;
                        if (this.value === 'update') {
                            showUpdateFields(userId);
                        } else {
                            hideUpdateFields(userId);
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>
