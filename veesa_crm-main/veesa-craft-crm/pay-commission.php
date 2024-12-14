<?php

include 'conn.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$saleId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($saleId == 0) {
    die("Invalid sale ID.");
}

$query = "SELECT * FROM sale WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $saleId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("No sale found with the given ID.");
}

$row = $result->fetch_assoc(); 

$apiKey = '96434309-7796-489d-8924-ab56988a6076';
$merchantId = 'PGTESTPAYUAT86';
$keyIndex = 1;

$fname = $row['sale_person'];
$amount = $row['c_amount'] * 100; // Amount in paisa
$number = mt_rand(100000000, 999999999); 

$paymentData = array(
    'merchantId' => $merchantId,
    'merchantTransactionId' => "MT7850590068188104", // Should be unique for each transaction
    'merchantUserId' => "MUID123", // Replace with the actual user ID if available
    'amount' => $amount,
    'redirectUrl' => "https://web2tech.org/veesa-craft-crm/paymentSuccess.php",
    'redirectMode' => "POST",
    'callbackUrl' => "https://web2tech.org/veesa-craft-crm/paymentSuccess.php",
    'merchantOrderId' => $number,
    'mobileNumber' => '',
    'message' => "Order description",
    'email' => '',
    'shortName' => $fname,
    'paymentInstrument' => array(
        'type' => "PAY_PAGE"
    )
);

$jsonencode = json_encode($paymentData);
$payloadMain = base64_encode($jsonencode);
$payload = $payloadMain . "/pg/v1/pay" . $apiKey;
$sha256 = hash("sha256", $payload);
$final_x_header = $sha256 . '###' . $keyIndex;
$request = json_encode(array('request' => $payloadMain));

// Initialize cURL
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $request,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "X-VERIFY: " . $final_x_header,
        "accept: application/json"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $res = json_decode($response, true);

   if (isset($res['success']) && $res['success'] == '1') {
    $paymentCode = $res['code'];
    $paymentMsg = $res['message'];
    $payUrl = $res['data']['instrumentResponse']['redirectInfo']['url'];

    $fname = $conn->real_escape_string($fname);
    $amount = $conn->real_escape_string($amount);
    
    $paymentStatus = 'success'; 

    $updateQuery = "UPDATE sale SET transaction_id = ?, payment_status = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);

    $stmt->bind_param('ssi', $paymentCode, $paymentStatus, $saleId);

    if ($stmt->execute()) {
        echo "Payment status updated successfully.";
    } else {
        echo "Failed to update payment status: " . $conn->error;
    }

    header('Location: ' . $payUrl);
    exit();
} else {
    echo "Payment failed: " . $res['message'];
}
}

$conn->close();
?>
