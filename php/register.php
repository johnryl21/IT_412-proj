<?php
require '../db/db_connection.php'; // Include the DB connection

session_start(); // Start the session
$pepper = "pepper_string"; // Static Pepper
$error = ''; // Variable to hold error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Password validation: must contain letters, numbers, and symbols
    if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
        $error = "Password must contain at least one letter, one number, and one special character.";
    } else {
        // Check if the username already exists
        $checkStmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $checkStmt->bind_param('s', $username);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            $error = "This username is already registered.";
        } else {
            // Generate a random salt
            $salt = bin2hex(random_bytes(32));

            // Hash password with salt and pepper
            $hashedPassword = hash('sha256', $salt . $password . $pepper);

            // Insert user into the database, including first and last names
            $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, password_hash, salt) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssss', $firstname, $lastname, $username, $hashedPassword, $salt);

            if ($stmt->execute()) {
                $_SESSION['username'] = $username; // Set session variable
                header('Location: main_page.php'); // Redirect to main page
                exit;
            } else {
                $error = "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $checkStmt->close();
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

        .registration-container {
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
            /* Add some spacing above the checkbox */
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

        .error-message {
            color: #e74c3c;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="registration-container">
        <h2>Sign Up for Free</h2>

        <!-- Show the error message if it exists -->
        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <div class="input-group">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" placeholder="Enter your first name" required>
            </div>
            <div class="input-group">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" placeholder="Enter your last name" required>
            </div>
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
            <button type="submit" class="submit-btn">Sign Up</button>
        </form>

        <div class="extra-info">
            By signing up, you agree to our <a href="#">Terms and Conditions</a>.
        </div>
        <div class="extra-info">
            Already have an Account? <a href="login.php">Go to Login</a>
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