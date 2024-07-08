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

// Get raw POST data and decode JSON
$data = json_decode(file_get_contents('php://input'), true);

// Check if data is valid
if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

$invoice_id = $data['invoice_id'];
$customername = $data['customername'];
$paymentValue = $data['paymentValue'];
$paymentMode = $data['paymentMode'];
$paymentStatus = $data['paymentStatus'];

try {
    $conn->autocommit(false); // Start transaction

    // Fetch customer ID based on customer name
    $stmt = $conn->prepare("SELECT customer_id FROM Customers WHERE name = ?");
    $stmt->bind_param('s', $customername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception('Customer not found');
    }

    $customer = $result->fetch_assoc();
    $customer_id = $customer['customer_id'];

    // Update invoice paid amount and status
    $stmt = $conn->prepare("UPDATE Invoice SET paid_amount = paid_amount + ?, payment_status = ? WHERE invoice_id = ?");
    $stmt->bind_param('dss', $paymentValue, $paymentStatus, $invoice_id);
    $stmt->execute();

    // Insert payment record
    $stmt = $conn->prepare("INSERT INTO Payment (customer_id, invoice_id, value, method, ref_no, payment_date, created_at, created_by, updated_at, updated_by) VALUES (?, ?, ?, ?, ?, NOW(), NOW(), 1, NOW(), 1)");
    $stmt->bind_param('iddss', $customer_id, $invoice_id, $paymentValue, $paymentMode, $invoice_id);
    $stmt->execute();

    // Commit transaction
    $conn->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

// Close connection
$conn->close();
?>
