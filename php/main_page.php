<?php
require '../db/db_connection.php'; // Include the DB connection

// Start a session to manage user login
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to register page if not logged in
    exit;
}

// Fetch user playlists or other data if needed
$username = $_SESSION['username'];
// Example query to fetch user's playlists (adjust according to your database structure)
// $playlists = $conn->query("SELECT * FROM playlists WHERE username = '$username'");

// For demonstration, we will use a static playlist array
$playlists = [
    ['title' => 'Chill Vibes', 'songs' => ['Song 1', 'Song 2', 'Song 3']],
    ['title' => 'Top Hits', 'songs' => ['Hit 1', 'Hit 2', 'Hit 3']],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page - Spotify Style</title>
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

        .welcome-message {
            font-size: 18px;
            color: #b3b3b3;
            margin-bottom: 20px;
        }

        .featured-playlist {
            background-color: #1c1c1c;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            margin: auto;
        }

        .playlist-title {
            font-size: 20px;
            color: #1DB954;
            margin-bottom: 10px;
        }

        .song {
            margin-bottom: 5px;
            font-size: 14px;
            color: #ffffff;
        }

        .logout-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #1DB954;
            color: #ffffff;
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
            <a href="#">Home</a>
            <a href="#">Library</a>
            <a href="#">Profile</a>
            <a href="register.php">Logout</a>
        </nav>
    </div>

    <div class="content">
        <h1>Welcome to MyMusic, <?php echo htmlspecialchars($username); ?>!</h1>
        <div class="welcome-message">Discover your favorite songs and playlists.</div>

        <?php foreach ($playlists as $playlist): ?>
            <div class="featured-playlist">
                <div class="playlist-title"><?php echo htmlspecialchars($playlist['title']); ?></div>
                <?php foreach ($playlist['songs'] as $song): ?>
                    <div class="song"><?php echo htmlspecialchars($song); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <button class="logout-btn" onclick="location.href='login.php'">Logout</button>
    </div>

</body>

</html>