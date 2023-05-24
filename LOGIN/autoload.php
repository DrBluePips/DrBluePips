<?php
// Include the Twilio PHP SDK
require_once 'vendor/autoload.php';

use Twilio\Rest\Client;

// Set your Twilio API credentials
$accountSid = 'ACc400f5e725e723dff95f4987439c4377';
$authToken = 'e62c871931a4f5263793aaa5723bad5a';
$twilioPhoneNumber = '+14344361230';

// Get form data from POST request
$name = $_POST['name'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$message = $_POST['message'];

// Compose the SMS message
$smsBody = "Name: $name\nEmail: $email\nPhone Number: $phoneNumber\nMessage: $message";

try {
    // Initialize the Twilio client
    $client = new Client($accountSid, $authToken);

    // Send the SMS message
    $client->messages->create(
        // Recipient's phone number
        'RECIPIENT_PHONE_NUMBER',
        array(
            // Sender's phone number
            'from' => $twilioPhoneNumber,
            // SMS message body
            'body' => $smsBody
        )
    );

    // Display success message
    echo "SMS sent successfully!";
} catch (Exception $e) {
    // Display error message
    echo "Error: " . $e->getMessage();
}
?>
