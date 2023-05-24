<?php
// MoMo Pay API endpoint
$apiEndpoint = 'https://sandbox.momodeveloper.mtn.com/disbursement/v1_0/bc-authorize';

// MoMo Pay API credentials
$apiKey = '3b4d0ca58a79444b8f60cc451a4a48a1';
$apiSecret = 'b5681d4a83124c18a9175904de205ba1';

// Payment confirmation data
$transactionId = '4003112127465'; // Replace with your transaction ID
$transactionRefId = '0787452065'; // Replace with your transaction reference ID
$amount = '1000'; // Replace with the amount to confirm
$description = 'murakoze kuba mugiye kwishyura drbluepips'; // Replace with your payment description

// Generate authentication hash
$rawHash = "partnerCode=" . $apiKey . "&accessKey=" . $apiSecret . "&requestId=" . $transactionId . "&orderId=" . $transactionRefId . "&amount=" . $amount . "&orderInfo=" . $description;
$hash = hash('sha256', $rawHash);

// Prepare request data
$requestData = array(
    'partnerCode' => $apiKey,
    'accessKey' => $apiSecret,
    'requestId' => $transactionId,
    'orderId' => $transactionRefId,
    'amount' => $amount,
    'orderInfo' => $description,
    'hash' => $hash
);

// Send POST request to MoMo Pay API
$ch = curl_init($apiEndpoint);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$response = curl_exec($ch);
curl_close($ch);

// Parse response
$responseData = json_decode($response, true);

// Check response status
if (isset($responseData['status']) && $responseData['status'] == 0) {
    // Payment confirmation successful
    echo 'Payment confirmation successful.';
    // Handle additional logic here, e.g. update order status in your system
} else {
    // Payment confirmation failed
    echo 'Payment confirmation failed. Error message: ' . $responseData['message'];
    // Handle error logic here
}
?>