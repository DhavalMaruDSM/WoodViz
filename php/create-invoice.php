<?php
include 'db.php';

// Get the invoice data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Escape input data
$invoice_number = $conn->real_escape_string($data['invoice_number']);
$customer_id = $conn->real_escape_string($data['customer_id']);
$gst_number = $conn->real_escape_string($data['gst_number']);
$pan_number = $conn->real_escape_string($data['pan_number']);
$invoice_date = $conn->real_escape_string($data['invoice_date']);
$due_date = $conn->real_escape_string($data['due_date']);
$note = $conn->real_escape_string($data['note']);
$items = $data['items'];

// Start transaction
$conn->begin_transaction();

try {
    // Calculate total GST amount
    $gst_amt = 0;
    foreach ($items as $item) {
        $gst_amt += $item['cgst_amount'] + $item['sgst_amount'] + $item['igst_amount'];
        $total += $conn->real_escape_string($item['total']);
    }

    // Insert invoice data into Invoice table
    $sql = "INSERT INTO Invoice (invoice_id, invoice_date, due_date, customer_id,invoice_value, gst, payment_status, paid_amount, payment_mode) 
            VALUES ('$invoice_number', '$invoice_date', '$due_date', '$customer_id','$total', '$gst_amt', 'Unpaid', '0.00', 'cash')";
    if (!$conn->query($sql)) {
        throw new Exception("Error inserting invoice data: " . $conn->error);
    }

    // Insert invoice items into Invoice_item table
    foreach ($items as $item) {
        $product_id = $conn->real_escape_string($item['product_id']);
        $qty = $conn->real_escape_string($item['qty']);
        $rate = $conn->real_escape_string($item['rate']);
        $taxable = $conn->real_escape_string($item['taxable']);
        $cgst_amount = $conn->real_escape_string($item['cgst_amount']);
        $sgst_amount = $conn->real_escape_string($item['sgst_amount']);
        $igst_amount = $conn->real_escape_string($item['igst_amount']);
        

        $sql1 = "INSERT INTO Invoice_item (invoice_id, product_id, quantity, unit_price, cgst, sgst, igst, total_value) 
                 VALUES ('$invoice_number', '$product_id', '$qty', '$rate', '$cgst_amount', '$sgst_amount', '$igst_amount', '$total')";
        if (!$conn->query($sql1)) {
            throw new Exception("Error inserting invoice item data: " . $conn->error);
        }
    }

    // Commit transaction
    $conn->commit();

    // Close connection
    $conn->close();

    echo json_encode(['status' => 'success', 'message' => 'Invoice created successfully!']);
} catch (Exception $e) {
    // Rollback transaction
    $conn->rollback();

    // Close connection
    $conn->close();

    echo json_encode(['status' => 'error', 'message' => 'Failed to create invoice: ' . $e->getMessage()]);
}
?>
