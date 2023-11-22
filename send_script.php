<?php
if (isset($_POST['send_message_btn'])) {
    // Sanitize and retrieve user inputs
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $msg = htmlspecialchars($_POST['msg']);

    // Set up the email headers and content
    $to = "drindaemarius@yahoo.com";
    $from = "From: $email\r\n";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= $from;

    // Construct the HTML message body
    $usermessage = "
    <html>
    <head>
    <title>Message from $name</title>
    </head>
    <body>
    <p>Name: $name</p>
    <p>Email: $email</p>
    <p>Subject: $subject</p>
    <p>Message: $msg</p>
    </body>
    </html>
    ";

    // Send the email
    if (mail($to, $subject, $usermessage, $headers)) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email. Please try again.";
    }
}
?>

