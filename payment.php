<?php
// payment.php

// Retrieve POST data
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];

// API endpoint and credentials
$apiUrl = "https://api.cashfree.com/pg/orders"; // Ensure this is the correct endpoint
$apiKey = 'TEST1031877946628cf3317ec3c83a6f97781301'; // Replace with your actual API key
$secretKey = 'cfsk_ma_test_5e908822d89a303aacfa4a912ce9aba4_96de369a'; // Replace with your actual secret key

// Generate a unique order ID based on the current timestamp
$id = date('ymdhis');

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "x-client-id: $apiKey",
    "x-client-secret: $secretKey",
    "x-api-version: 2023-08-01",
    "Content-Type: application/json"
));

// Define the JSON data for the request
$data = json_encode(array(
    "order_id" => "order_$id",
    "order_amount" => 10.10,
    "order_currency" => "INR",
    "order_note" => "Additional order info",
    "customer_details" => array(
        "customer_id" => $id,
        "customer_name" => $name,
        "customer_email" => $email,
        "customer_phone" => $mobile
    )
));

// Set the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Decode the JSON response
    $decodedResponse = json_decode($response, true);
    echo json_encode($decodedResponse); // Output the response for debugging
}

// Close the cURL session
curl_close($ch);
?>
