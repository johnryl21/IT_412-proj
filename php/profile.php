<?php
require '../db/db_connection.php'; // Include the DB connection
session_start(); // Start the session

if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login if user is not logged in
    exit;
}

$username = $_SESSION['username'];
$query = "SELECT firstname, lastname, username, password_hash FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #1c1c1c;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .logo {
            font-size: 24px;
            color: #1DB954;
        }

        .nav {
            display: flex;
            gap: 20px;
        }

        .nav a {
            color: #b3b3b3;
            text-decoration: none;
            font-weight: bold;
        }

        .nav a:hover {
            color: #1DB954;
        }

        .content {
            margin-top: 20px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #1DB954;
        }

        .profile-container {
            background-color: #1c1c1c;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
            color: #fff;
        }

        h2 {
            color: #1DB954;
            margin-bottom: 20px;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #b3b3b3;
            margin-bottom: 8px;
        }

        .profile-info p {
            background-color: #333;
            padding: 12px;
            border-radius: 7px;
            font-size: 14px;
            color: #fff;
            word-break: break-all;
        }

        .logout-btn {
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

        .logout-btn:hover {
            background-color: #18a248;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="logo">MyMusic</div>
        <nav class="nav">
            <a href="main_page.php">Home</a>
            <a onclick="location.href='profile.php'">Profile</a>
            <a onclick="location.href='logout.php'">Logout</a>
        </nav>
    </div>
    <br>

    <div class="profile-container">
        <h2>Your Profile</h2>

        <div class="profile-info">
            <label for="firstname">First Name</label>
            <p id="firstname"><?php echo htmlspecialchars($user['firstname']); ?></p>
        </div>
        <div class="profile-info">
            <label for="lastname">Last Name</label>
            <p id="lastname"><?php echo htmlspecialchars($user['lastname']); ?></p>
        </div>
        <div class="profile-info">
            <label for="username">Username</label>
            <p id="username"><?php echo htmlspecialchars($user['username']); ?></p>
        </div>
        <div class="profile-info">
            <label for="password_hash">Password Hash</label>
            <p id="password_hash"><?php echo htmlspecialchars($user['password_hash']); ?></p>
        </div>

        <form action="logout.php" method="POST">
            <button type="submit" class="logout-btn">Log Out</button>
        </form>
    </div>

</body>

</html>