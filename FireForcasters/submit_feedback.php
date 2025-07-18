<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to DB and process form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];
    $rating = $_POST['rating'];

    // Replace with your DB connection logic
    $conn = new mysqli("localhost", "root", "", "campaign_feedback");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, feedback, rating) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $feedback, $rating);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error submitting feedback.";
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo "Method Not Allowed";
}
?>
