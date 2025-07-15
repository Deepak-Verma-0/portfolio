<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $name    = trim($_POST['name']);
    $email   = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $phone   = htmlspecialchars(trim($_POST['phone']), ENT_QUOTES);
    $message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES);

    // Simple validation
    if (!$name || !$email || !$message) {
        die('Please fill in all required fields.');
    }

    // Recipient & subject
    $to      = 'yourname@example.com';  // Change to your email
    $subject = 'New Contact Form Submission';

    // Build HTML message
    $body  = "<h2>Contact Request</h2>";
    $body .= "<p><strong>Name:</strong> $name</p>";
    $body .= "<p><strong>Email:</strong> $email</p>";
    $body .= "<p><strong>Phone:</strong> $phone</p>";
    $body .= "<p><strong>Message:</strong><br>" . nl2br($message) . "</p>";

    // Email headers
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the mail
    if (mail($to, $subject, $body, $headers)) {
        echo '<p>Your message has been sent successfully!</p>';
        
    } else {
        echo '<p>Sorry, there was an error sending your message.</p>';
    }
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>
