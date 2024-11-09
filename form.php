<?php
session_start();

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $message = sanitizeInput($_POST['message']);

    $inquiryData = "Name: $name\nEmail: $email\nMessage: $message\n\n";
    file_put_contents('inquiries.txt', $inquiryData, FILE_APPEND);

    echo "Thank you for reaching out!";
} else {
    echo "Invalid request method.";
}
?>