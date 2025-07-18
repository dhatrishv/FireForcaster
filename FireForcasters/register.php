<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Username already exists. Please choose a different one.";
        $_SESSION['type'] = "error";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Registration successful!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Database error: " . $stmt->error;
            $_SESSION['type'] = "error";
        }
    }

    $_SESSION['from'] = 'register';
    header("Location: index.php");
    exit();
}
?>
