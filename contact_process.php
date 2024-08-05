<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $to = "robinskroy600@gmail.com";
    $from = htmlspecialchars($_POST['email']);
    $name = htmlspecialchars($_POST['name']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate the form fields
    if (empty($from) || empty($name) || empty($subject) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    // Set email headers
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    // Email subject
    $email_subject = "You have a message from your Bitmap Photography.";

    // Email body
    $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Email</title></head><body>";
    $body .= "<table style='width: 100%;'>";
    $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
    $body .= "<a href='#'><img src='img/logo.png' alt=''></a><br><br>";
    $body .= "</td></tr></thead><tbody><tr>";
    $body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
    $body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
    $body .= "</tr>";
    $body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$subject}</td></tr>";
    $body .= "<tr><td colspan='2' style='border:none;'>{$message}</td></tr>";
    $body .= "</tbody></table>";
    $body .= "</body></html>";

    // Send email
    if (mail($to, $email_subject, $body, $headers)) {
        echo "Message sent successfully.";
    } else {
        echo "Failed to send message.";
    }
} else {
    echo "Invalid request.";
}
?>
