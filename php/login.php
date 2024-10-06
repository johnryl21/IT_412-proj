<?php
require '../db/db_connection.php'; // Include the DB connection

session_start(); // Start the session
$pepper = "pepper_string"; // Static Pepper
$error = ''; // Variable to hold error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Get user details from the database
    $stmt = $conn->prepare("SELECT password_hash, salt FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($dbPasswordHash, $salt);
    $stmt->fetch();

    if ($dbPasswordHash) {
        // Verify password with salt and pepper
        $hashedPassword = hash('sha256', $salt . $password . $pepper);

        if ($hashedPassword === $dbPasswordHash) {
            $_SESSION['username'] = $username; // Set session variable
            header('Location: main_page.php'); // Redirect on success
            exit;
        } else {
            $error = "Invalid credentials!";
        }
    } else {
        $error = "Invalid credentials!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #121212;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #1c1c1c;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 380px;
            text-align: center;
            color: #fff;
        }

        h2 {
            color: #1DB954;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #b3b3b3;
            margin-bottom: 8px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            background-color: #333;
            border: 1px solid #333;
            border-radius: 7px;
            font-size: 14px;
            color: #fff;
            box-sizing: border-box;
        }

        .input-group input::placeholder {
            color: #b3b3b3;
        }

        .show-password {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #1DB954;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #18a248;
        }

        .error-message {
            color: #e74c3c;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .extra-info {
            margin-top: 20px;
            font-size: 12px;
            color: #b3b3b3;
        }

        .extra-info a {
            color: #1DB954;
            text-decoration: none;
        }

        .extra-info a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Login to Your Account</h2>

        <!-- Show the error message if it exists -->
        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username or email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="show-password">
                <input type="checkbox" id="show-password">
                <label for="show-password" style="margin-left: 8px; color: #b3b3b3;">Show Password</label>
            </div>
            <br>
            <button type="submit" class="submit-btn">Login</button>
        </form>
        <div class="extra-info">
            Don't have an account? <a href="register.php">Sign up here</a>.
        </div>
    </div>

    <script>
        // Show/Hide Password functionality
        const passwordField = document.getElementById('password');
        const showPasswordCheckbox = document.getElementById('show-password');

        showPasswordCheckbox.addEventListener('change', function () {
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>

</body>

</html>