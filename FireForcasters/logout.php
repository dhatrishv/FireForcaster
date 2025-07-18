<?php
session_start();

// Save username before destroying session
$username = $_SESSION['username'] ?? 'User';

// Destroy all session data
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logged Out | FireFo</title>
    <style>
        body {
            background:url('thank.png') no-repeat;
            background-size: cover;
            background-position: center;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-box {
            background:transparent;
            backdrop-filter: blur(10px);
            padding: 40px 60px;
            border-radius: 10px;
            border: 2px solid rgba(255,255,255,.5);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            text-align: center;
        }
        .message-box h1 {
            font-size: 24px;
            color: white;
        }
        .message-box a {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            padding: 10px 20px;
            background: #1e55ee;
            color: white;
            border-radius: 6px;
        }
        .message-box a:hover {
            background-color: #5a6a97;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h1>"Thank you, <?= htmlspecialchars($username) ?>, 
        for visiting our the website and take time to provide your valuable feedback."</h1>
        <a href="feedback.php">Feedback</a>
    </div>
</body>
</html>
