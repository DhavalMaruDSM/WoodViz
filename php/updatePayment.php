<?php
header('Content-Type: application/json');

$servername = "154.41.233.52";
$username = "u839503646_admin";
$password = "Ads@2024";
$dbname = "u839503646_woodviz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

$invoice_id = $data['invoice_id'];
$customername = $data['customername'];
$paymentValue = $data['paymentValue'];
$paymentMode = $data['paymentMode'];
$paymentStatus = $data['paymentStatus'];
$refrno = $data['refrenceno'];

file_put_contents('php://stderr', print_r($data, true));

try {
    $conn->autocommit(false);

    $stmt = $conn->prepare("SELECT customer_id FROM Customers WHERE name = ?");
    if (!$stmt) {
        throw new Exception("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param('s', $customername);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception('Customer not found');
    }

    $customer = $result->fetch_assoc();
    $customer_id = $customer['customer_id'];

    $stmt = $conn->prepare("UPDATE Invoice SET paid_amount = paid_amount + ?, payment_status = ?, payment_mode = ? WHERE invoice_id = ?");
    if (!$stmt) {
        throw new Exception("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param('dssi', $paymentValue, $paymentStatus, $paymentMode, $invoice_id);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    error_log("Payment Status: " . $paymentStatus);

    $stmt = $conn->prepare("INSERT INTO Payment (customer_id, invoice_id, value, method, ref_no, payment_date, created_at, created_by, updated_at, updated_by) VALUES (?, ?, ?, ?, ?, NOW(), NOW(), 1, NOW(), 1)");
    if (!$stmt) {
        throw new Exception("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param('iidss', $customer_id, $invoice_id, $paymentValue, $paymentMode, $refrno);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    $conn->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>
