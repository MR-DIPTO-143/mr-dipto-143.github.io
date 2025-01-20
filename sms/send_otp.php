<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $msisdn = $_POST['msisdn'];

    if (empty($msisdn)) {
        die("Phone number is required.");
    }

    // API URL
    $url = "https://fundesh.com.bd/api/auth/generateOTP";

    // Request data
    $data = [
        "msisdn" => $msisdn
    ];

    // Initialize cURL
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL and get response
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Close cURL
    curl_close($ch);

    // Check response
    if ($httpCode == 200) {
        echo "OTP sent successfully!";
    } else {
        echo "Failed to send OTP. Response: " . $response;
    }
}
?>
