<?php
// payment.php

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$apiUrl = "https://api.cashfree.com/pg";
$apiKey = 'TEST1031877946628cf3317ec3c83a6f97781301';
$secretKey = 'cfsk_ma_test_5e908822d89a303aacfa4a912ce9aba4_96de369a';
$id = date('y'.'m'.'d'.'H'.'i'.'s');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "x-client-id: $apiKey",
    'x-api-version: 2023-08-01',
    "x-client-secret: $secretKey"
    'Content-Type: application/json',
));

$data = <<< json {
    "order_id":"order_$id",
    "order_amount": 10.10,
    "order_currency": "INR",
    "order_note":"Additional order info",
    "customer_details":{
      "customer_id": "$id",
      "customer_name": "$name",
      "customer_email": "$email",
      "customer_phone": "$mobile"
    }
}
JSON;
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
$response = curl_exec($ch);
echo"$response";

?>
