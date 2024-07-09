<?php
include 'db.php';

// Ensure fromDate and toDate are set and not empty
if (isset($_GET['fromDate']) && isset($_GET['toDate'])) {
    $fromDate = $_GET['fromDate'];
    $toDate = $_GET['toDate'];

    // Prepare SQL query with date range condition
    $sql = "SELECT i.invoice_date AS date,
                   i.invoice_id AS invoice_id,
                   c.name AS customerName,
                   i.payment_mode AS paymentMode,
                   p.ref_no AS ref,
                   p.value
            FROM Customers c
            INNER JOIN Invoice i ON c.customer_id = i.customer_id
            INNER JOIN Payment p ON c.customer_id = p.customer_id
            WHERE i.invoice_date BETWEEN '$fromDate' AND '$toDate'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        // Set response header
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo json_encode(array("message" => "No transaction activity data found for the given date range"));
    }
} else {
    echo json_encode(array("message" => "Please provide both fromDate and toDate parameters"));
}

// Close the database connection
$conn->close();
?>
