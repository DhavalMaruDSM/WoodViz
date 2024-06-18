<?php
include "db.php";

$account_name = $_POST['account_name'];
$address_line1 = $_POST['address_line1'];
$address_line2 = $_POST['address_line2'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$city = $_POST['city'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];
$gst = $_POST['gst'];
$pan = $_POST['pan'];
$ifsc = $_POST['ifsc'];
$balance= $_POST['balance'];
$bank_account= $_POST['bank_account'];



$created_at = date('Y-m-d H:i:s'); 


$sql = "INSERT INTO Customers (name, address_line_1, address_line_2, city, state, pincode, phone, email, gst, pan, created_at,balance,bank_account,ifsc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Error: " . $conn->error;
    exit();
}

$stmt->bind_param("ssssssssssssds", $account_name, $address_line1, $address_line2, $city, $state, $pincode, $mobile, $email, $gst, $pan, $created_at,$balance,$bank_account,$ifsc);

if ($stmt->execute()) {
    echo "Account created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
